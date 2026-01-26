<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Coupon;


class CartController extends Controller
{
    protected function getUserCart(): Cart
    {
        return Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);
    }

   public function index(): View
    {
        $cart = $this->getUserCart()->load('items.product');

        $subtotal = $cart->items->sum('total_price');

        // ✅ Fetch ONLY eligible coupons
        $coupons = Coupon::where('is_active', 1)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                ->orWhere('expires_at', '>=', now());
            })
            ->where('min_cart_value', '<=', $subtotal)
            ->whereDoesntHave('users', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->get();

        return view('cart.index', compact('cart', 'coupons', 'subtotal'));
    }


    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $quantity = $data['quantity'] ?? 1;

        $product = Product::where('status', 'active')->findOrFail($data['product_id']);
        $cart = $this->getUserCart();

        $item = $cart->items()->where('product_id', $product->id)->first();

        $unitPrice = $product->discount_price ?? $product->price;

        if ($item) {
            $item->quantity += $quantity;
            $item->total_price = $item->quantity * $unitPrice;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $unitPrice * $quantity,
            ]);
        }

        return redirect()->route('account.cart.index')->with('status', 'Product added to cart.');
    }

    public function update(Request $request, CartItem $item): RedirectResponse
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        abort_unless($item->cart->user_id === auth()->id(), 403);

        $item->quantity = (int) $request->input('quantity');
        $item->total_price = $item->quantity * $item->unit_price;
        $item->save();

        return redirect()->route('account.cart.index')->with('status', 'Cart updated.');
    }

    public function destroy(CartItem $item): RedirectResponse
    {
        abort_unless($item->cart->user_id === auth()->id(), 403);

        $item->delete();

        return redirect()->route('account.cart.index')->with('status', 'Item removed from cart.');
    }

    public function updatequit(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        abort_unless($item->cart->user_id === auth()->id(), 403);

        // 1️⃣ Update item quantity
        $item->quantity = $request->quantity;
        $item->total_price = $item->unit_price * $request->quantity;
        $item->save();

        // 2️⃣ Recalculate subtotal
        $subtotal = $item->cart->items()->sum('total_price');

        // 3️⃣ Recalculate coupon discount if applied
        $discount = 0;

        if (session()->has('applied_coupon')) {
            $couponData = session('applied_coupon');
            $coupon = \App\Models\Coupon::find($couponData['id']);

            if ($coupon && $coupon->isUsable()) {
                $discount = \App\Services\CouponService::calculateDiscount($coupon, $subtotal);

                // Update session coupon discount
                session([
                    'applied_coupon.discount' => $discount
                ]);
            } else {
                // Remove coupon if invalid
                session()->forget('applied_coupon');
            }
        }

        // 4️⃣ Final total
        $total = max($subtotal - $discount, 0);

        // 5️⃣ Return updated values
        return response()->json([
            'quantity'   => $item->quantity,
            'item_total' => $item->total_price,
            'subtotal'   => $subtotal,
            'discount'   => $discount,
            'total'      => $total,
        ]);
    }


}

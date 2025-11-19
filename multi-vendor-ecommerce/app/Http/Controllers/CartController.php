<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

        return view('cart.index', compact('cart'));
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
}

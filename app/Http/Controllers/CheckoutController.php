<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    protected function getUserCart(): ?Cart
    {
        return Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->first();
    }

    public function index(): RedirectResponse|View
    {
        $cart = $this->getUserCart();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('account.cart.index')->with('status', 'Your cart is empty.');
        }

        $user = auth()->user();

        return view('checkout.index', compact('cart', 'user'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = $this->getUserCart();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('account.cart.index')->with('status', 'Your cart is empty.');
        }

        $data = $request->validate([
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_email' => ['required', 'email', 'max:255'],
            'shipping_phone' => ['required', 'string', 'max:30'],
            'shipping_address_line1' => ['required', 'string', 'max:255'],
            'shipping_address_line2' => ['nullable', 'string', 'max:255'],
            'shipping_city' => ['required', 'string', 'max:100'],
            'shipping_state' => ['required', 'string', 'max:100'],
            'shipping_postal_code' => ['required', 'string', 'max:20'],
            'shipping_country' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ]);

        $subtotal = $cart->items->sum('total_price');
        $discount = 0;
        $shipping = 0;
        $total = $subtotal - $discount + $shipping;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'cod',
                'subtotal_amount' => $subtotal,
                'discount_amount' => $discount,
                'shipping_amount' => $shipping,
                'total_amount' => $total,
                'currency' => 'INR',
                'shipping_name' => $data['shipping_name'],
                'shipping_email' => $data['shipping_email'],
                'shipping_phone' => $data['shipping_phone'],
                'shipping_address_line1' => $data['shipping_address_line1'],
                'shipping_address_line2' => $data['shipping_address_line2'] ?? null,
                'shipping_city' => $data['shipping_city'],
                'shipping_state' => $data['shipping_state'],
                'shipping_postal_code' => $data['shipping_postal_code'],
                'shipping_country' => $data['shipping_country'] ?? 'India',
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'vendor_id' => $item->product->vendor_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->total_price,
                ]);
            }

            Payment::create([
                'order_id' => $order->id,
                'provider' => 'cod',
                'amount' => $total,
                'status' => 'pending',
                'provider_payment_id' => null,
                'payload' => null,
            ]);

            $cart->items()->delete();
            $cart->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()->route('account.checkout.index')->with('status', 'Unable to place order. Please try again.');
        }

        return redirect()->route('account.orders.show', $order)->with('status', 'Order placed successfully.');
    }
}

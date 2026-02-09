<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\View\View;

class AccountOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['items.product.images']) 
            ->latest()
            ->paginate(10);

        return view('account.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $order->load('items.product', 'payment');

        return view('account.orders.show', compact('order'));
    }

    public function reorder(Order $order)
    {
        // 1. Ensure the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // 2. Get or Create the user's active cart
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        // 3. Loop through items of the old order
        foreach ($order->items as $item) {
            // Check if product still exists and is active
            $product = $item->product;
            
            if ($product && $product->status === 'active') {
                // Check if item already in current cart
                $existingItem = $cart->items()->where('product_id', $product->id)->first();

                if ($existingItem) {
                    // Just update quantity
                    $existingItem->increment('quantity', $item->quantity);
                } else {
                    // Create new cart item
                    $cart->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'unit_price' => $product->price,
                        'total_price' => $product->price * $item->quantity,
                    ]);
                }
            }
        }

        return redirect()->route('account.cart.index')
            ->with('status', 'Items from Order #' . $order->order_number . ' have been added to your cart.');
    }
}

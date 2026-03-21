<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $vendorId = auth()->id();

        $query = Order::whereHas('items', function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            })
            ->with('user')
            ->withCount(['items as items_count' => function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId);
            }])
            ->latest();

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(20);

        return view('vendor.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $vendorId = auth()->id();

        abort_unless($order->items()->where('vendor_id', $vendorId)->exists(), 403);

        $order->load([
            'user',
            'payment',
            'deliveryBoy',
            'items' => function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId)->with('product');
            },
        ]);

        $deliveryBoys = \App\Models\User::where('role', 'delivery_boy')->get();

        return view('vendor.orders.show', compact('order', 'deliveryBoys'));
    }

    /**
     * Manually Assign Delivery Boy
     */
    public function assignDelivery(Request $request, Order $order): \Illuminate\Http\RedirectResponse
    {
        $vendorId = auth()->id();
        abort_unless($order->items()->where('vendor_id', $vendorId)->exists(), 403);

        $request->validate([
            'delivery_boy_id' => 'required|exists:users,id'
        ]);

        $order->update([
            'delivery_boy_id' => $request->delivery_boy_id,
            'delivery_status' => 'assigned',
            'assigned_at' => now(),
            'delivery_otp' => rand(1000, 9999)
        ]);

        return back()->with('status', 'Delivery boy assigned successfully.');
    }
}

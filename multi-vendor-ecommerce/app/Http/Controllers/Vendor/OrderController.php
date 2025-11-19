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
            'items' => function ($q) use ($vendorId) {
                $q->where('vendor_id', $vendorId)->with('product');
            },
        ]);

        return view('vendor.orders.show', compact('order'));
    }
}

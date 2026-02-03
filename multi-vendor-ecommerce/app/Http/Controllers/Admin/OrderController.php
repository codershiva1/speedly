<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        // Eager loading user to prevent N+1 issues
        $query = Order::with('user')->latest();

        // Filter by Status (pending, confirmed, shipped, etc.)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by Payment Status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        // Loading all necessary relations
        $order->load(['user', 'items.product', 'items.vendor']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update Order Status (Confirmed, Shipped, Delivered, etc.)
     */
   public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => 'required|string|in:pending,confirmed,shipped,delivered,cancelled,returned',
            'payment_status' => 'required|string|in:pending,paid,failed,refunded'
        ]);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status
        ]);

        return back()->with('status', 'Order status updated successfully.');
    }
    
}
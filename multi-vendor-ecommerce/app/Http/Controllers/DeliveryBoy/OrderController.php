<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = Order::where('delivery_boy_id', $user->id)
            ->whereIn('delivery_status', ['assigned', 'picked_up', 'out_for_delivery'])
            ->latest()
            ->paginate(10);
            
        return view('delivery.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->delivery_boy_id !== auth()->id()) {
            abort(403);
        }

        return view('delivery.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if ($order->delivery_boy_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:picked_up,out_for_delivery,delivered',
            'otp' => 'required_if:status,delivered',
            'pod_image' => 'nullable|image|max:2048'
        ]);

        if ($request->status === 'delivered') {
            if ($request->otp !== $order->delivery_otp) {
                return back()->with('error', 'Invalid OTP.');
            }
            
            if ($request->hasFile('pod_image')) {
                $order->pod_image = $request->file('pod_image')->store('pod', 'public');
            }

            $order->delivered_at = now();
            
            // 1. Sync main order status
            $order->status = 'delivered';
            
            // 2. COD Settlement
            if ($order->payment_method === 'cod') {
                $order->payment_status = 'paid';
                
                // Find and update the associated Payment record if any
                $payment = \App\Models\Payment::where('order_id', $order->id)->first();
                if ($payment) {
                    $payment->update(['status' => 'paid']);
                }
                
                // Add cash_in_hand to Rider Profile
                $profile = auth()->user()->deliveryBoyProfile;
                if ($profile) {
                    $profile->increment('cash_in_hand', $order->total_amount);
                }
            }
            
            // 3. Earnings Calculation (Flat ₹40 Payout for demo)
            \App\Models\DeliveryBoyEarning::create([
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'amount' => 40.00,
                'type' => 'payout',
                'description' => 'Delivery Payout for Order #' . $order->order_number
            ]);
        }

        if ($request->status === 'picked_up') {
            $order->picked_up_at = now();
        }

        $order->delivery_status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated successfully');
    }
}

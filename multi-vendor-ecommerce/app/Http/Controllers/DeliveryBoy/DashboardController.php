<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\DeliveryBoyProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $profile = $user->deliveryBoyProfile;
        
        // 1. Core Stats
        $todayEarnings = \App\Models\DeliveryBoyEarning::where('user_id', $user->id)
                            ->whereDate('created_at', today())
                            ->sum('amount');
                            
        $activeOrdersCount = \App\Models\Order::where('delivery_boy_id', $user->id)
                                ->whereIn('delivery_status', ['assigned', 'picked_up', 'out_for_delivery'])
                                ->count();
                                
        $todayCodCollected = \App\Models\Order::where('delivery_boy_id', $user->id)
                                ->where('delivery_status', 'delivered')
                                ->where('payment_method', 'cod')
                                ->whereDate('delivered_at', today())
                                ->sum('total_amount');
                                
        $rating = $profile->rating ?? 5.0;

        // 2. Productivity metrics
        $completedToday = \App\Models\Order::where('delivery_boy_id', $user->id)
                            ->where('delivery_status', 'delivered')
                            ->whereDate('delivered_at', today())
                            ->get();

        // Avg Delivery Time (pickup to delivery in mins)
        $avgDeliveryTime = 0;
        if ($completedToday->count() > 0) {
            $totalMinutes = $completedToday->sum(function($order) {
                return $order->picked_up_at && $order->delivered_at 
                    ? $order->picked_up_at->diffInMinutes($order->delivered_at) 
                    : 0;
            });
            $avgDeliveryTime = round($totalMinutes / $completedToday->count());
        }

        // Orders Per Hour (based on active shift time)
        $ordersPerHour = 0;
        if ($profile && $profile->is_on_shift && $profile->last_shift_start) {
            $shiftDurationHours = $profile->last_shift_start->diffInHours(now()) ?: 1;
            $ordersPerHour = round($completedToday->count() / $shiftDurationHours, 1);
        }

        // Acceptance Rate
        $assignmentsToday = \App\Models\DeliveryOrderAssignment::where('delivery_boy_id', $user->id)
                                ->whereDate('created_at', today())
                                ->count();
        $acceptedToday = \App\Models\DeliveryOrderAssignment::where('delivery_boy_id', $user->id)
                                ->whereDate('created_at', today())
                                ->where('status', 'accepted')
                                ->count();
        $acceptanceRate = $assignmentsToday > 0 ? round(($acceptedToday / $assignmentsToday) * 100) : 100;
        
        $ongoingDeliveries = \App\Models\Order::where('delivery_boy_id', $user->id)
                                ->whereIn('delivery_status', ['assigned', 'picked_up', 'out_for_delivery'])
                                ->latest()
                                ->take(5)
                                ->get();

        $completedCount = $completedToday->count();
        $dailyTarget = 10;
        
        return view('delivery.dashboard', compact(
            'todayEarnings', 
            'activeOrdersCount', 
            'rating', 
            'ongoingDeliveries',
            'avgDeliveryTime',
            'ordersPerHour',
            'acceptanceRate',
            'todayCodCollected',
            'completedCount',
            'dailyTarget',
            'profile'
        ));
    }

    public function checkNewOrders()
    {
        $newOrder = Order::where('delivery_boy_id', auth()->id())
            ->where('delivery_status', 'assigned')
            ->where('assigned_at', '>=', now()->subSeconds(35))
            ->first();

        if ($newOrder) {
            return response()->json([
                'new_order' => true,
                'order_id' => $newOrder->id,
                'message' => "New order #{$newOrder->id} assigned to you!"
            ]);
        }

        return response()->json(['new_order' => false]);
    }
}

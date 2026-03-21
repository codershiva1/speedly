<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DeliveryReview;
use Carbon\Carbon;

class PerformanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->deliveryBoyProfile;

        // 1. Success Metrics
        $totalAssigned = Order::where('delivery_boy_id', $user->id)->count();
        $completedCount = Order::where('delivery_boy_id', $user->id)
                            ->where('delivery_status', 'delivered')
                            ->count();
        
        $successRate = $totalAssigned > 0 ? round(($completedCount / $totalAssigned) * 100) : 100;

        // 2. Timing Metrics (Pickup to Delivery)
        $completedToday = Order::where('delivery_boy_id', $user->id)
                            ->where('delivery_status', 'delivered')
                            ->whereNotNull('picked_up_at')
                            ->whereNotNull('delivered_at')
                            ->get();

        $avgTime = 0;
        if ($completedToday->count() > 0) {
            $totalMins = $completedToday->sum(function($order) {
                return $order->picked_up_at->diffInMinutes($order->delivered_at);
            });
            $avgTime = round($totalMins / $completedToday->count());
        }

        // 3. Feedback & Ratings
        $avgRating = $profile->rating ?? 5.0;
        $reviewsList = DeliveryReview::where('delivery_boy_id', $user->id)
                            ->with('customer')
                            ->latest()
                            ->paginate(10);

        // 4. Milestone/Incentive Check (Demo logic)
        $ordersNeededForBonus = max(0, 10 - $completedToday->where('delivered_at', '>=', today())->count());

        return view('delivery.performance', compact(
            'successRate', 
            'avgTime', 
            'avgRating', 
            'reviewsList',
            'completedCount',
            'ordersNeededForBonus'
        ));
    }
}

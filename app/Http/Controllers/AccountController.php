<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function dashboard(Request $request): View
    {
        $user = $request->user();

        $ordersCount = Order::where('user_id', $user->id)->count();
        $pendingOrdersCount = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();
        $completedOrdersCount = Order::where('user_id', $user->id)
            ->whereIn('status', ['confirmed', 'shipped', 'delivered'])
            ->count();
        $totalSpent = Order::where('user_id', $user->id)->sum('total_amount');

        $recentOrders = Order::where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('customer.dashboard', compact(
            'ordersCount',
            'pendingOrdersCount',
            'completedOrdersCount',
            'totalSpent',
            'recentOrders'
        ));
    }
}

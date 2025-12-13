<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalRevenue = Order::sum('total_amount');
        $ordersCount = Order::count();
        $productsCount = Product::count();
        $vendorsCount = User::where('role', 'vendor')->count();
        $customersCount = User::where('role', 'customer')->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'ordersCount',
            'productsCount',
            'vendorsCount',
            'customersCount',
            'recentOrders'
        ));
    }
}

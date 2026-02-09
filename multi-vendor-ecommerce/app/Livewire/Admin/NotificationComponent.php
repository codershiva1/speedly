<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class NotificationComponent extends Component
{
    public function render()
    {
        // 1. Latest 5 Low Stock Products
        $lowStockProducts = Product::where('stock_quantity', '<=', 5)
            ->latest()
            ->take(5)
            ->get();

        // 2. Latest 5 Pending Orders
        $recentOrders = Order::where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // 3. Latest 5 New Users (Last 24 Hours)
        $recentUsers = User::where('created_at', '>=', now()->subHours(24))
            ->latest()
            ->take(5)
            ->get();

        $totalCount = Product::where('stock_quantity', '<=', 5)->count() + 
                    Order::where('status', 'pending')->count() + 
                    User::where('created_at', '>=', now()->subHours(24))->count();

        return view('livewire.admin.notification-component', [
            'lowStockProducts' => $lowStockProducts,
            'recentOrders' => $recentOrders,
            'recentUsers' => $recentUsers,
            'totalCount' => $totalCount
        ]);
    }
}
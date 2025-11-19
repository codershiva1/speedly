<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $vendorId = Auth::id();

        $productsCount = Product::where('vendor_id', $vendorId)->count();

        $orderItemsQuery = OrderItem::where('vendor_id', $vendorId);
        $ordersCount = (clone $orderItemsQuery)->distinct('order_id')->count('order_id');
        $revenue = (clone $orderItemsQuery)->sum('total_price');

        $recentOrders = Order::whereHas('items', function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        })
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('vendor.dashboard', compact(
            'productsCount',
            'ordersCount',
            'revenue',
            'recentOrders'
        ));
    }
}

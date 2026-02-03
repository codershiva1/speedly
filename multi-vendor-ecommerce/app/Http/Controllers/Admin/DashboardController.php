<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Brand;
use App\Models\Coupon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index() 
    {
        // User counts based on roles
        $totalUsers = \App\Models\User::count();
        $totalAdmins = \App\Models\User::where('role', 'admin')->count();
        $totalVendors = \App\Models\User::where('role', 'vendor')->count();
        $totalCustomers = \App\Models\User::where('role', 'customer')->count();

        // Stats variables
        $revenue = \App\Models\Order::where('payment_status', 'paid')->sum('total_amount');
        $totalOrders = \App\Models\Order::count();
        $totalBrands = \App\Models\Brand::count();
        $activeCoupons = \App\Models\Coupon::where('is_active', 1)->count();
        
        $recentOrders = \App\Models\Order::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalAdmins', 'totalVendors', 'totalCustomers',
            'revenue', 'totalOrders', 'totalBrands', 'activeCoupons', 'recentOrders'
        ));
    }
}
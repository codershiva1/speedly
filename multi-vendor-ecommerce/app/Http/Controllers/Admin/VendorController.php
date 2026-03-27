<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = User::where('role', 'vendor')
            ->with('vendorProfile')
            ->withCount(['products', 'vendorOrderItems as orders_count'])
            ->latest()
            ->paginate(10);
        return view('admin.vendors.index', compact('vendors'));
    }

    public function show(User $vendor)
    {
        $vendor->load(['vendorProfile', 'products']);
        
        $salesData = \App\Models\OrderItem::where('vendor_id', $vendor->id)
            ->selectRaw('SUM(total_price) as total_revenue, COUNT(id) as total_orders')
            ->first();

        $recentOrders = \App\Models\OrderItem::with('order')
            ->where('vendor_id', $vendor->id)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.vendors.show', compact('vendor', 'salesData', 'recentOrders'));
    }

    public function approve(User $vendor)
    {
        if ($vendor->vendorProfile) {
            $vendor->vendorProfile->update(['status' => 'approved']);
            return back()->with('success', 'Vendor approved successfully.');
        }
        return back()->with('error', 'Vendor profile not found.');
    }

    public function reject(User $vendor)
    {
        if ($vendor->vendorProfile) {
            $vendor->vendorProfile->update(['status' => 'rejected']);
            return back()->with('success', 'Vendor rejected.');
        }
        return back()->with('error', 'Vendor profile not found.');
    }
}

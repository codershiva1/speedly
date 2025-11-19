<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\VendorProfile;
use Illuminate\View\View;

class VendorStorefrontController extends Controller
{
    public function index(): View
    {
        $vendors = VendorProfile::where('status', 'approved')
            ->with('user')
            ->withCount('products')
            ->orderBy('store_name')
            ->paginate(12);

        return view('vendors.index', compact('vendors'));
    }

    public function show(string $slug): View
    {
        $vendor = VendorProfile::where('slug', $slug)
            ->where('status', 'approved')
            ->with('user')
            ->firstOrFail();

        $products = Product::with('images', 'category', 'brand')
            ->where('vendor_id', $vendor->user_id)
            ->where('status', 'active')
            ->latest()
            ->paginate(12);

        return view('vendors.show', compact('vendor', 'products'));
    }
}

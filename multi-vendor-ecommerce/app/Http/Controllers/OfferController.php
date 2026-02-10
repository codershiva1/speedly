<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdPlacement;
use App\Models\AdClick;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        // Fetch placements with their active ads
        $placements = AdPlacement::with(['ads' => function($q) {
            $q->active()->orderBy('priority', 'desc');
        }])->where('is_active', true)->get()->keyBy('key');

        return view('offers.index', compact('placements'));
    }

    public function trackClick(Ad $ad)
    {
        // Record the click in your ad_clicks table
        AdClick::create([
            'ad_id' => $ad->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
        ]);

        // 2. Logic for Product Redirection (Requires Slug)
    if ($ad->target_type === 'product' && $ad->target_id) {
        $product = Product::find($ad->target_id);
        if ($product) {
            // Redirects to: /product/product-slug-here
            return redirect()->route('shop.show', $product->slug);
        }
    }

    // 3. Logic for Category Redirection (Requires Slug as Query Parameter)
    if ($ad->target_type === 'category' && $ad->target_id) {
        $category = Category::find($ad->target_id);
        if ($category) {
            // Redirects to: /shop?category=category-slug-here
            return redirect()->route('shop.index', ['category' => $category->slug]);
        }
    }

    // Fallback if target not found
    return redirect('/');
    }
}
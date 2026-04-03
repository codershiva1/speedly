<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        $brands = \App\Models\Brand::where('status', 'active')
            ->orderBy('name')
            ->take(15) // Adjust as needed
            ->get();

        $topCategories = Category::withCount('products')
            ->where('status', 'active')
            ->orderByDesc('products_count')
            ->take(20)
            ->get();

        $baseProductQuery = Product::with([
        'images',
        'categories',
        ...(auth()->check() ? ['cartItem'] : [])
        ])
        ->where('status', 'active');

        // -----------------

        // --- THE 5 VARIETY SECTIONS ---

        // Helper to fill empty slots
        $fillProducts = function($collection, $neededLimit) use ($baseProductQuery) {
            $currentCount = $collection->count();
            if ($currentCount >= $neededLimit) return $collection;

            $needed = $neededLimit - $currentCount;
            $existingIds = $collection->pluck('id')->toArray();
            
            $extra = (clone $baseProductQuery)
                ->when(!empty($existingIds), fn($q) => $q->whereNotIn('id', $existingIds))
                ->inRandomOrder()
                ->take($needed)
                ->get();

            return $collection->merge($extra);
        };

        // SECTION 1: Mega Flash Deals (Sorted by highest savings amount)
        $megaDeals = (clone $baseProductQuery)
            ->whereNotNull('discount_price')
            ->selectRaw('*, (price - discount_price) as total_savings')
            ->orderByDesc('total_savings')
            ->take(6)
            ->get();
        $megaDeals = $fillProducts($megaDeals, 6);

        // SECTION 2: New Arrivals (Freshness)
        $newProducts = (clone $baseProductQuery)
            ->latest()
            ->take(10)
            ->get();
        $newProducts = $fillProducts($newProducts, 10);

        // SECTION 3: Trending Now (Social Proof - using view_count or random popularity)
        $trendingProducts = (clone $baseProductQuery)
            ->where('is_featured', false) // Differentiate from featured
            ->inRandomOrder() 
            ->take(8)
            ->get();
        $trendingProducts = $fillProducts($trendingProducts, 8);

        // SECTION 4: Handpicked Featured (Curated by Admin)
        $featuredProducts = (clone $baseProductQuery)
            ->where('is_featured', true)
            ->take(10)
            ->get();
        $featuredProducts = $fillProducts($featuredProducts, 10);

        // SECTION 5: Budget Store (Under ₹199 - High Conversion)
        $budgetStore = (clone $baseProductQuery)
            ->where('price', '<', 199)
            ->take(6)
            ->get();
        $budgetStore = $fillProducts($budgetStore, 6);
        // ---------------------

       $placements = \App\Models\AdPlacement::with(['ads' => function($q) {
            $q->active()->orderBy('priority', 'desc');
        }])
        ->whereIn('key', ['home_slider', 'home_triple_banner', 'home_budget_sidebar'])
        ->where('is_active', true)
        ->get()
        ->keyBy('key');


        return view('home', [
            'categories' => $categories,
            'topCategories' => $topCategories,
            'megaDeals' => $megaDeals,
            'newProducts' => $newProducts,
            'trendingProducts' => $trendingProducts,
            'featuredProducts' => $featuredProducts,
            'budgetStore' => $budgetStore,
            'adsplacements' => $placements,
            'brands' => $brands,
        ]);
    }
}

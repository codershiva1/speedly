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

        // 1. Time-Based Logic (Smart Dynamic Section)
        $hour = now()->hour;
        if ($hour >= 11 && $hour < 17) {
            $timeSlotData = [
                'greeting' => 'Good Afternoon',
                'title' => 'Lunch & Snacks',
                'badge' => 'Quick Bites',
                'icon' => 'sun-high',
                'query_type' => 'snacks',
                'slugs' => ['instant-food', 'drinks-juices', 'sauces-spreads']
            ];
        } elseif ($hour >= 17 && $hour < 22) {
            $timeSlotData = [
                'greeting' => 'Good Evening',
                'title' => 'Dinner Essentials',
                'badge' => 'Daily Fresh',
                'icon' => 'moon-stars',
                'query_type' => 'dinner',
                'slugs' => ['fruits-vegetables', 'atta-rice-dal', 'masala-dry-fruits', 'cleaners-repellents']
            ];
        } elseif ($hour >= 22 || $hour < 5) {
            $timeSlotData = [
                'greeting' => 'Good Night',
                'title' => 'Late Night Cravings',
                'badge' => 'Midnight Needs',
                'icon' => 'alarm',
                'query_type' => 'late-night',
                'slugs' => ['ice-creams-more', 'sweets-chocolates', 'instant-food']
            ];
        } else {
            // Early morning default
             $timeSlotData = [
                'greeting' => 'Good Morning',
                'title' => 'Morning Essentials',
                'badge' => 'Breakfast & Dairy',
                'icon' => 'sun-low',
                'query_type' => 'breakfast',
                'slugs' => ['dairy-bread-eggs', 'tea-coffee-milk-drinks', 'fruits-vegetables']
            ];
        }

        // Fetch Smart Products specifically for this hour
        $smartProducts = (clone $baseProductQuery)
            ->whereHas('categories', function($q) use ($timeSlotData) {
                $q->whereIn('slug', $timeSlotData['slugs']);
            })
            ->inRandomOrder()
            ->take(8)
            ->get();

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

        // SECTION 6: Buy It Again (Personalized past purchases)
        $buyItAgainProducts = collect();
        if (auth()->check()) {
            $pastProductIds = \App\Models\OrderItem::whereHas('order', function($q) {
                $q->where('user_id', auth()->id())->where('status', '!=', 'cancelled');
            })->latest()->pluck('product_id')->unique()->take(10)->toArray();

            if (!empty($pastProductIds)) {
                $buyItAgainProducts = (clone $baseProductQuery)
                    ->whereIn('id', $pastProductIds)
                    ->get();
            }
        }
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
            'buyItAgainProducts' => $buyItAgainProducts,
            'adsplacements' => $placements,
            'brands' => $brands,
            'timeSlotData' => $timeSlotData,
            'smartProducts' => $smartProducts,
        ]);
    }
}

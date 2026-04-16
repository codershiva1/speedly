<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\AdPlacement;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        // Fetch all top-level categories (All where parent_id is null)
        $allTopCategories = Category::whereNull('parent_id')
            ->where('status', 'active')
            ->withCount('products')
            ->orderBy('name')
            ->get();

        // 3. Featured Brands
        $brands = Brand::where('status', 'active')->take(12)->get();

        // 4. Promo Placements
        $categoryAds = AdPlacement::with(['ads' => function($q) {
                $q->active();
            }])
            ->where('key', 'off_hero')
            ->first();

        return view('categories.index', compact(
            'allTopCategories', 
            'brands', 
            'categoryAds'
        ));
    }
}
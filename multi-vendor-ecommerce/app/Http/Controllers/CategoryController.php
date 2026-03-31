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
        // 1. Parent Categories (Those that HAVE children)
        $parentCategories = Category::whereNull('parent_id')
            ->has('children')
            ->where('status', 'active')
            ->with(['children' => function($q) {
                $q->where('status', 'active')->withCount('products');
            }])
            ->get();

        // 2. Standalone Categories (No parent AND no children)
        // This ensures categories that aren't part of a group still show up
        $standaloneCategories = Category::whereNull('parent_id')
            ->doesntHave('children')
            ->where('status', 'active')
            ->withCount('products')
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
            'parentCategories', 
            'standaloneCategories',
            'brands', 
            'categoryAds'
        ));
    }
}
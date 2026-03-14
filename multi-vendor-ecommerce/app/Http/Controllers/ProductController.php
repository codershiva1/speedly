<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->get('category');
        $brandSlug = $request->get('brand'); // Get the brand from URL

        $type = $request->get('type');

        // Start with the same base query as HomeController for consistency
        $query = Product::with([
            'images',
            'category',
            ...(auth()->check() ? ['cartItem'] : [])
        ])->where('status', 'active');

        // 1. Handle "View All" for Variety Sections (Mega Deals, New Arrivals, etc.)
        if ($type) {
            switch ($type) {
                case 'mega-deals':
                    $query->whereNotNull('discount_price')
                          ->selectRaw('*, (price - discount_price) as total_savings')
                          ->orderByDesc('total_savings');
                    $title = "Mega Flash Deals";
                    break;

                case 'new-arrivals':
                    $query->latest();
                    $title = "New Arrivals";
                    break;

                case 'trending':
                    $query->where('is_featured', false)->inRandomOrder(); 
                    $title = "Trending Now";
                    break;

                case 'featured':
                    $query->where('is_featured', true);
                    $title = "Handpicked Featured";
                    break;

                case 'budget-store':
                    $query->where('price', '<', 199);
                    $title = "Budget Store (Under ₹199)";
                    break;

                default:
                    $title = "Products";
            }

            return view('products.products-all', [
                'title' => $title,
                'products' => $query->paginate(100)->appends(['type' => $type]),
                'isFiltered' => true
            ]);
        }

        // Handle Brand Filter
        if ($brandSlug) {
            $brand = Brand::where('slug', $brandSlug)->firstOrFail();
            $products = Product::where('brand_id', $brand->id)
                ->with(['images', 'cartItem'])
                ->paginate(100);

            return view('products.products-all', [
                'title' => 'Brand: ' . $brand->name,
                'products' => $products,
                'isFiltered' => true
            ]);
        }

        if ($categorySlug) {
            // "View All" State: Show flat grid for specific category
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $products = Product::where('category_id', $category->id)
                ->with(['images', 'cartItem'])
                ->paginate(100);

            return view('products.products-all', [
                'title' => $category->name,
                'products' => $products,
                'isFiltered' => true
            ]);
        }

        // Default State: Group by Parent Categories
        // Fetch parent categories that actually have products
        $sections = Category::whereNull('parent_id')
            ->with(['products' => function($q) {
                $q->with(['images', 'cartItem'])->limit(12);
            }])
            ->get()
            ->filter(fn($cat) => $cat->products->count() > 0);

        return view('products.products-all', [
            'title' => 'Our Catalog',
            'sections' => $sections,
            'isFiltered' => false
        ]);
    }
}
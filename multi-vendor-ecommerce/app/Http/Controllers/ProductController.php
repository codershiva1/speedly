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
        $brandSlug = $request->get('brand');
        $type = $request->get('type');
        $sort = $request->get('sort');

        // Start with the base query
        $query = Product::with([
            'images',
            'category',
            ...(auth()->check() ? ['cartItem'] : [])
        ])->where('status', 'active');

        $title = "Our Catalog";

        // 1. Handle Type Filter
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
            }
        }

        // 2. Handle Brand Filter
        $selectedBrands = collect();
        if ($brandSlug) {
            $brandSlugs = array_filter(explode(',', $brandSlug));
            $selectedBrands = Brand::whereIn('slug', $brandSlugs)->get();
            if ($selectedBrands->count() > 0) {
                $query->whereIn('brand_id', $selectedBrands->pluck('id'));
                if ($selectedBrands->count() == 1) {
                    $title = 'Brand: ' . $selectedBrands->first()->name;
                } else {
                    $title = $selectedBrands->count() . ' Brands Selected';
                }
            }
        }

        // 3. Handle Category Filter
        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $query->where('category_id', $category->id);
            $title = $category->name;
        }

        // 4. Handle Sorting & Multiple Price Ranges
        if ($sort) {
            $sorts = array_filter(explode(',', $sort));
            
            // Extract price ranges
            $ranges = array_filter($sorts, fn($s) => str_starts_with($s, 'range_'));
            if (count($ranges) > 0) {
                $query->where(function ($q) use ($ranges) {
                    foreach ($ranges as $r) {
                        if ($r == 'range_0_99') $q->orWhere('price', '<=', 99);
                        if ($r == 'range_99_199') $q->orWhereBetween('price', [99, 199]);
                        if ($r == 'range_199_299') $q->orWhereBetween('price', [199, 299]);
                        if ($r == 'range_299_499') $q->orWhereBetween('price', [299, 499]);
                        if ($r == 'range_499_999') $q->orWhereBetween('price', [499, 999]);
                        if ($r == 'range_999_plus') $q->orWhere('price', '>', 999);
                    }
                });
            }

            // Apply ordering
            if (in_array('price_asc', $sorts)) {
                $query->orderBy('price', 'asc');
            } elseif (in_array('price_desc', $sorts)) {
                $query->orderBy('price', 'desc');
            } elseif (in_array('latest', $sorts)) {
                $query->latest();
            }
        }

        // If any filter is applied OR AJAX is requested, show FLAT GRID
        if ($brandSlug || $categorySlug || $sort || $type || $request->ajax()) {
            $products = $query->paginate(24)->appends($request->all());

            if ($request->ajax()) {
                // If it's pure PJAX, we return the whole page, BUT if someone uses intersection observer
                // we technically just want the grid. But because we're going to use PJAX on the frontend,
                // we can just let JS handle the full HTML, OR return JSON if we want infinite scroll to append.
                // Let's stick to the JSON for infinite scroll only!
                if ($request->has('page')) {
                     return response()->json([
                        'html' => view('products.partials.flat_grid', compact('products'))->render(),
                        'next_page' => $products->nextPageUrl()
                    ]);
                }
            }

            return view('products.products-all', [
                'title' => $title,
                'products' => $products,
                'isFiltered' => true,
                'brands' => Brand::where('status', 'active')->take(15)->get(),
                'selectedBrands' => $selectedBrands,
            ]);
        }

        // Default State: Group by Parent Categories (NO FILTERS)
        $sections = Category::whereNull('parent_id')
            ->with(['products' => function($q) {
                $q->with(['images', 'cartItem'])->limit(12);
            }])
            ->get()
            ->filter(fn($cat) => $cat->products->count() > 0);

        return view('products.products-all', [
            'title' => 'Our Catalog',
            'sections' => $sections,
            'isFiltered' => false,
            'brands' => Brand::where('status', 'active')->take(15)->get(),
            'selectedBrands' => collect(),
            'products' => null,
        ]);
    }
}
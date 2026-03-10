<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->get('category');

        if ($categorySlug) {
            // "View All" State: Show flat grid for specific category
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $products = Product::where('category_id', $category->id)
                ->with(['images', 'cartItem'])
                ->paginate(24);

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
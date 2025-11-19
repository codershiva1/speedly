<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('images', 'category', 'brand')
            ->where('status', 'active');

        $search = $request->input('q');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $selectedCategory = $request->input('category');
        if ($selectedCategory) {
            $query->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        $minPrice = $request->input('min_price');
        if ($minPrice !== null && $minPrice !== '') {
            $query->where('price', '>=', (float) $minPrice);
        }

        $maxPrice = $request->input('max_price');
        if ($maxPrice !== null && $maxPrice !== '') {
            $query->where('price', '<=', (float) $maxPrice);
        }

        $products = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::with('images', 'category')
            ->where('status', 'active')
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $filters = [
            'q' => $search,
            'category' => $selectedCategory,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
        ];

        return view('shop.index', compact('products', 'categories', 'featuredProducts', 'filters'));
    }

    public function show(string $slug): View
    {
        $product = Product::with('images', 'category', 'brand', 'vendor')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $approvedReviews = $product->reviews()
            ->where('status', 'approved')
            ->with('user')
            ->latest()
            ->get();

        $averageRating = $approvedReviews->avg('rating');
        $ratingCount = $approvedReviews->count();

        return view('shop.show', compact('product', 'approvedReviews', 'averageRating', 'ratingCount'));
    }
}

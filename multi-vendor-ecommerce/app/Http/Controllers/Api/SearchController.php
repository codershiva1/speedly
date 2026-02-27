<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = trim($request->query('q'));
        $user = auth()->user();

        // IF SEARCH QUERY IS EMPTY, FETCH "DEFAULT" CONTENT
        if (empty($q)) {
            $categories = Category::limit(20)->get(['id', 'name', 'slug', 'image']);
            
            $products = Product::with(['images', 'cartItem'])
                ->where('is_featured', true) // Or use ->latest()
                ->limit(100)
                ->get();
        } 
        else {
            // YOUR EXISTING SEARCH LOGIC
            $categories = Category::where('name', 'LIKE', "%{$q}%")
                ->limit(5)
                ->get(['id', 'name', 'slug', 'image']);

            $products = Product::where('name', 'LIKE', "%{$q}%")
                ->orWhere('meta_keywords', 'LIKE', "%{$q}%")
                ->with(['images', 'cartItem'])
                ->limit(12)
                ->get();
        }

        // MAP PRODUCTS (This part stays the same as your original code)
        $mappedProducts = $products->map(function ($product) use ($user) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'discount_price' => $product->discount_price,
                'size' => $product->size,
                'image' => optional($product->images->first())->path,
                'in_wishlist' => $user ? $user->wishlist->contains('product_id', $product->id) : false,
                'in_cart' => $product->cartItem ? true : false,
            ];
        });

        return response()->json([
            'categories' => $categories,
            'products' => $mappedProducts,
            'is_default' => empty($q) // Add this flag to change titles in JS
        ]);
    }
}

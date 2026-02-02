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

        if (strlen($q) < 2) {
            return response()->json([
                'categories' => [],
                'products' => []
            ]);
        }

        // Categories
        $categories = Category::where('name', 'LIKE', "%{$q}%")
            ->limit(5)
            ->get(['id', 'name', 'slug', 'image']);

        // Products
        $products = Product::where('name', 'LIKE', "%{$q}%")
            ->orWhere('meta_keywords', 'LIKE', "%{$q}%")
            ->with(['images', 'cartItem'])
            ->limit(12)
            ->get()
            ->map(function ($product) use ($user) {

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'discount_price' => $product->discount_price,
                    'size' => $product->size,
                    'image' => optional($product->images->first())->path,

                    // 👇 CRITICAL STATE FLAGS
                    'in_wishlist' => $user
                        ? $user->wishlist->contains('product_id', $product->id)
                        : false,

                    'in_cart' => $product->cartItem ? true : false,
                ];
            });

        return response()->json([
            'categories' => $categories,
            'products' => $products
        ]);
    }
}

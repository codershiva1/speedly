<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
   public function show(Request $request, int $price)
{
    $search = $request->q;

    $products = Product::with([
        'category.parent',
        'images',

        // ✅ FIXED cartItem eager load
        'cartItem' => function ($q) {
            $q->whereHas('cart', function ($cart) {
                $cart->where('user_id', auth()->id());
            });
        }
    ])
    ->where('status', 'active')
    ->where('price', '<=', $price)
    ->when($search, function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%");
    })
    ->get()
    ->groupBy(function ($product) {
        return optional($product->category->parent)->name ?? 'Other';
    });

    return view('stores.show', [
        'price'    => $price,
        'products' => $products,
        'search'   => $search,
    ]);
}


}

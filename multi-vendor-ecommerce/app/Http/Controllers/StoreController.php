<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Ad;
use App\Models\AdPlacement;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function show(Request $request, int $price)
{
    $search = $request->q;

    // 1. Products grouped by category
    $groupedProducts = Product::with([
        'category.parent',
        'images',
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
    ->groupBy(function ($item) {
        return optional($item->category->parent)->name ?? 'Other';
    });

    // 2. Separate Banners for the Top Slider
    $topBanners = Ad::active()
        ->whereHas('adPlacement', fn($q) => $q->where('key', 'store_top_banner'))
        ->get();

    // 3. Separate Sponsored Products (to be injected between categories)
    $inlineAds = Ad::active()
        ->whereHas('adPlacement', fn($q) => $q->where('key', 'store_inline'))
        ->with(['target.images', 'target.cartItem'])
        ->get();

    return view('stores.show', [
        'price'           => $price,
        'products'        => $groupedProducts,
        'topBanners'      => $topBanners,
        'inlineAds'       => $inlineAds,
        'search'          => $search,
    ]);
}
}
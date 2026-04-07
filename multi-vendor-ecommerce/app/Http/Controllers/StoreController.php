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
        $search = $request->q ?? '';
        $sort   = $request->sort ?? 'default';

        // -----------------------------------------------
        // Build base product query
        // -----------------------------------------------
        $query = Product::with([
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
        ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"));

        // -----------------------------------------------
        // Apply sorting / price range filters
        // -----------------------------------------------
        match ($sort) {
            'price_asc'      => $query->orderBy('price', 'asc'),
            'price_desc'     => $query->orderBy('price', 'desc'),
            'range_0_99'     => $query->where('price', '<=', 99)->orderBy('price'),
            'range_99_199'   => $query->whereBetween('price', [99, 199])->orderBy('price'),
            'range_199_299'  => $query->whereBetween('price', [199, 299])->orderBy('price'),
            'range_299_499'  => $query->whereBetween('price', [299, 499])->orderBy('price'),
            'range_499_999'  => $query->whereBetween('price', [499, 999])->orderBy('price'),
            'range_999_plus' => $query->where('price', '>', 999)->orderBy('price'),
            default          => $query->latest(),
        };

        $groupedProducts = $query->get()->groupBy(function ($item) {
            return optional($item->category->parent)->name ?? 'Other';
        });

        // -----------------------------------------------
        // AJAX request → return only the products HTML
        // -----------------------------------------------
        if ($request->ajax()) {
            $html = view('partials.store-products', [
                'products'  => $groupedProducts,
                'inlineAds' => collect(), // no ad injection on live-filter requests
            ])->render();

            return response()->json(['html' => $html]);
        }

        // -----------------------------------------------
        // Full-page load → fetch banners & ads too
        // -----------------------------------------------
        $topBanners = Ad::active()
            ->whereHas('adPlacement', fn($q) => $q->where('key', 'store_top_banner'))
            ->get();

        $inlineAds = Ad::active()
            ->whereHas('adPlacement', fn($q) => $q->where('key', 'store_inline'))
            ->where('target_type', \App\Models\Product::class)
            ->whereNotNull('target_id')
            ->with(['target.images', 'target.cartItem'])
            ->get();

        return view('stores.show', [
            'price'      => $price,
            'products'   => $groupedProducts,
            'topBanners' => $topBanners,
            'inlineAds'  => $inlineAds,
            'search'     => $search,
            'sort'       => $sort,
        ]);
    }
}
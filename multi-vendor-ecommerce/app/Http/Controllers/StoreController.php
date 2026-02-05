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

        // 🔹 Normal Products
        $products = Product::with([
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
        ->get();

        // 🔹 Store Inline Ads
        $placement = AdPlacement::where('key', 'store_inline')->first();

        $ads = collect();
        if ($placement) {
            $ads = Ad::active()
                ->where('ad_placement_id', $placement->id)
                ->with(['target.images'])
                ->orderByDesc('priority')
                ->get();
        }

        // 🔹 Merge ads with products (every 6 items)
        $finalItems = $this->mergeAds($products, $ads, 6);

        // 🔹 Group by parent category (ads stay inline)
        $grouped = $finalItems->groupBy(function ($item) {
            if (!empty($item->is_ad)) {
                return '__ads__'; // ads not grouped
            }
            return optional($item->category->parent)->name ?? 'Other';
        });

        return view('stores.show', [
            'price'    => $price,
            'products' => $grouped,
            'search'   => $search,
        ]);
    }

    /**
     * Inject ads into product list
     */
    private function mergeAds($products, $ads, int $interval = 6)
    {
        if ($ads->isEmpty()) {
            return $products;
        }

        $result  = collect();
        $adIndex = 0;

        foreach ($products->values() as $index => $product) {

            if ($index > 0 && $index % $interval === 0 && isset($ads[$adIndex])) {
                $ad = $ads[$adIndex];
                $ad->is_ad = true;
                $result->push($ad);
                $adIndex++;
            }

            $product->is_ad = false;
            $result->push($product);
        }

        return $result;
    }
}

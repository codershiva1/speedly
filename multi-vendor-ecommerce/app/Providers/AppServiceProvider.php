<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $wishlistCount = auth()->check()
                ? Wishlist::where('user_id', auth()->id())->count()
                : 0;

            $view->with('wishlistCount', $wishlistCount);
       });


       View::composer('*', function ($view) {
            $cartCount = 0;

            if (auth()->check()) {
                $cart = Cart::where('user_id', auth()->id())
                    ->withCount('items')
                    ->first();

                $cartCount = $cart?->items_count ?? 0;
            }

            $view->with('cartCount', $cartCount);
        });
    }
}

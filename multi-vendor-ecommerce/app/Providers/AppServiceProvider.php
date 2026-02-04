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


        /* =========================
           Cart Count + Cart Total
        ========================== */
        View::composer('*', function ($view) {
            $cartCount = 0;
            $cartTotal = 0;

            if (auth()->check()) {
                $cart = Cart::where('user_id', auth()->id())
                    ->with(['items']) // IMPORTANT
                    ->first();

                if ($cart) {
                    // Number of cart rows
                    $cartCount = $cart->items->count();

                    // Sum of stored total_price column
                    $cartTotal = $cart->items->sum('total_price');
                }
            }

            $view->with([
                'cartCount' => $cartCount,
                'cartTotal' => $cartTotal,
            ]);
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Wishlist;
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
    }
}

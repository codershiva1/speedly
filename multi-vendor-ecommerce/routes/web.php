<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\VendorStorefrontController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\ProductController as VendorProductController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Static content pages used in header/footer
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/faq', [PageController::class, 'faq'])->name('pages.faq');
Route::get('/service', [PageController::class, 'service'])->name('pages.service');
Route::get('/find-store', [PageController::class, 'findStore'])->name('pages.find-store');
Route::get('/wishlist', [PageController::class, 'wishlist'])->name('pages.wishlist');
Route::get('/blog', [PageController::class, 'blog'])->name('pages.blog');

// ----------new pages --------------
Route::get('/terms', [PageController::class, 'terms'])->name('pages.terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('pages.privacy');
Route::get('/return-refund', [PageController::class, 'refunds'])->name('pages.return-refund');
Route::get('/shipping', [PageController::class, 'shipping'])->name('pages.shipping');
Route::get('/vendor-agreement', [PageController::class, 'vendor_policy'])->name('pages.vendor-agreement');
Route::get('/cancellation', [PageController::class, 'cancellation'])->name('pages.cancellation');
Route::get('/cookie', [PageController::class, 'cookie_policy'])->name('pages.cookie');


Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('shop.show');
Route::post('/product/{product:slug}/reviews', [ProductReviewController::class, 'store'])
    ->middleware('auth')
    ->name('shop.reviews.store');

Route::get('/vendors', [VendorStorefrontController::class, 'index'])->name('vendors.index');
Route::get('/vendors/{slug}', [VendorStorefrontController::class, 'show'])->name('vendors.show');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if (! $user) {
        return redirect()->route('login');
    }

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->isVendor()) {
        return redirect()->route('vendor.dashboard');
    }

    return redirect()->route('account.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('account')
    ->name('account.')
    ->middleware(['auth', 'verified',])
    ->group(function () {
        Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('dashboard');

        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
        Route::patch('/cart/items/{item}', [CartController::class, 'update'])->name('cart.items.update');
        Route::delete('/cart/items/{item}', [CartController::class, 'destroy'])->name('cart.items.destroy');

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

        Route::get('/orders', [AccountOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AccountOrderController::class, 'show'])->name('orders.show');
    });

Route::prefix('vendor')
    ->name('vendor.')
    ->middleware(['auth', 'verified', 'role:vendor'])
    ->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', VendorProductController::class);
        Route::resource('orders', VendorOrderController::class)->only(['index', 'show']);
    });

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('brands', AdminBrandController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    });

require __DIR__.'/auth.php';

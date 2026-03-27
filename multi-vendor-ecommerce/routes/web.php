<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CouponController as FrontCouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VendorStorefrontController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\ProductController as VendorProductController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;
use App\Http\Controllers\DeliveryBoy\DashboardController as DeliveryBoyDashboardController;
use App\Http\Controllers\DeliveryBoy\OrderController as DeliveryBoyOrderController;
use App\Http\Controllers\DeliveryBoy\EarningController as DeliveryBoyEarningController;
use App\Http\Controllers\DeliveryBoy\ProfileController as DeliveryBoyProfileController;
use App\Http\Controllers\DeliveryBoy\ShiftController;
use App\Http\Controllers\DeliveryBoy\PerformanceController;
use App\Http\Controllers\DeliveryBoy\NotificationController;
use App\Http\Controllers\DeliveryBoy\SOSController;
use App\Http\Controllers\DeliveryBoy\SupportController;
use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SearchController as AdminSearchController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
Route::get('/', [HomeController::class , 'index'])->name('home');


// Static content pages used in header/footer
Route::get('/about', [PageController::class , 'about'])->name('pages.about');
Route::get('/faq', [PageController::class , 'faq'])->name('pages.faq');
Route::get('/service', [PageController::class , 'service'])->name('pages.service');
Route::get('/find-store', [PageController::class , 'findStore'])->name('pages.find-store');
// Route::get('/wishlist', [PageController::class, 'wishlist'])->name('pages.wishlist');
Route::get('/blog', [PageController::class , 'blog'])->name('pages.blog');

// ----------new pages --------------
Route::get('/terms', [PageController::class , 'terms'])->name('pages.terms');
Route::get('/privacy', [PageController::class , 'privacy'])->name('pages.privacy');
Route::get('/return-refund', [PageController::class , 'refunds'])->name('pages.return-refund');
Route::get('/shipping', [PageController::class , 'shipping'])->name('pages.shipping');
Route::get('/vendor-agreement', [PageController::class , 'vendor_policy'])->name('pages.vendor-agreement');
Route::get('/cancellation', [PageController::class , 'cancellation'])->name('pages.cancellation');
Route::get('/cookie', [PageController::class , 'cookie_policy'])->name('pages.cookie');

Route::get('/search', [PageController::class , 'search'])->name('search.index');

Route::get('/stores/{price}', [StoreController::class , 'show'])->whereNumber('price')->name('stores.show');

Route::get('/categories', [CategoryController::class , 'index'])->name('categories.index');

Route::get('/catalog', [ProductController::class , 'index'])->name('products.all');

Route::get('/shop', [ShopController::class , 'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class , 'show'])->name('shop.show');
Route::post('/product/{product:slug}/reviews', [ProductReviewController::class , 'store'])
    ->middleware('auth')
    ->name('shop.reviews.store');

Route::get('/vendors', [VendorStorefrontController::class , 'index'])->name('vendors.index');
Route::get('/vendors/{slug}', [VendorStorefrontController::class , 'show'])->name('vendors.show');

// The main deals page
Route::get('/offers', [OfferController::class , 'index'])->name('offers.index');
// The click tracker (tracks then redirects to the product/category)
Route::get('/offers/click/{ad}', [OfferController::class , 'trackClick'])->name('offers.click');


Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->isVendor()) {
        return redirect()->route('vendor.dashboard');
    }

    if ($user->isDeliveryBoy()) {
        return redirect()->route('delivery.dashboard');
    }

    return redirect()->route('account.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
    Route::post('/profile/address', [ProfileController::class , 'storeAddress'])->name('profile.address.store');
    Route::put('/profile/address/{address}', [ProfileController::class , 'updateAddress'])->name('profile.address.update');
});

Route::prefix('account')
    ->name('account.')
    ->middleware([
        'auth', 
        'verified',
        \App\Http\Middleware\RestrictDeliveryBoy::class
    ])
    ->group(function () {
        Route::get('/dashboard', [AccountController::class , 'dashboard'])->name('dashboard');

        Route::get('/cart', [CartController::class , 'index'])->name('cart.index');
        Route::post('/cart', [CartController::class , 'store'])->name('cart.store');
        Route::patch('/cart/items/{item}', [CartController::class , 'update'])->name('cart.items.update');
        Route::delete('/cart/items/{item}', [CartController::class , 'destroy'])->name('cart.items.destroy');

        Route::post('/cart/toggle/{product}', [CartController::class , 'toggle'])
            ->name('cart.toggle');


        Route::post('/cart/items/{item}/ajax',
        [CartController::class , 'updatequit']
        )->name('cart.items.update.ajax');

        Route::post('/coupon/apply', [FrontCouponController::class , 'apply'])->name('coupon.apply');
        Route::post('/coupon/remove', [FrontCouponController::class , 'remove'])->name('coupon.remove');

        Route::get('/checkout', [CheckoutController::class , 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class , 'store'])->name('checkout.store');

        Route::get('/orders', [AccountOrderController::class , 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AccountOrderController::class , 'show'])->name('orders.show');
        Route::post('/orders/{order}/reorder', [AccountOrderController::class , 'reorder'])->name('orders.reorder');
    });



Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class , 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class , 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{wishlist}', [WishlistController::class , 'destroy'])->name('wishlist.destroy');
});


Route::prefix('vendor')
    ->name('vendor.')
    ->middleware(['auth', 'verified', 'role:vendor'])
    ->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class , 'index'])->name('dashboard');
        Route::resource('products', VendorProductController::class);
        Route::resource('orders', VendorOrderController::class)->only(['index', 'show']);
        Route::post('orders/{order}/assign', [VendorOrderController::class , 'assignDelivery'])->name('orders.assign');
    });

Route::prefix('delivery')
    ->name('delivery.')
    ->middleware(['auth', 'verified', 'role:delivery_boy'])
    ->group(function () {
        Route::get('/dashboard', [DeliveryBoyDashboardController::class , 'index'])->name('dashboard');
        Route::get('/check-new-orders', [DeliveryBoyDashboardController::class, 'checkNewOrders'])->name('check-new-orders');
        Route::resource('orders', DeliveryBoyOrderController::class)->only(['index', 'show', 'update']);
        Route::post('orders/{order}/status', [DeliveryBoyOrderController::class , 'updateStatus'])->name('orders.status');

        Route::get('/earnings', [DeliveryBoyEarningController::class, 'index'])->name('earnings');
        Route::post('/earnings/withdraw', [DeliveryBoyEarningController::class, 'requestWithdrawal'])->name('earnings.withdraw');

        Route::get('/performance', [PerformanceController::class, 'index'])->name('performance');
        
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/clear', [NotificationController::class, 'markAllAsRead'])->name('notifications.clear');

        Route::get('/profile', [DeliveryBoyProfileController::class , 'index'])->name('profile');
        Route::post('/profile', [DeliveryBoyProfileController::class , 'update'])->name('profile.update');
        Route::post('/profile/toggle-status', [DeliveryBoyProfileController::class , 'updateOnlineStatus'])->name('profile.toggle-status');
        Route::post('/shift/toggle', [ShiftController::class , 'toggleShift'])->name('shift.toggle');
        Route::post('/shift/break', [ShiftController::class , 'toggleBreak'])->name('shift.break');
        Route::post('/sos', [SOSController::class, 'store'])->name('sos.store');

        Route::get('/support', [SupportController::class, 'index'])->name('support');
        Route::post('/support/send', [SupportController::class, 'sendMessage'])->name('support.send');
        Route::get('/training', [SupportController::class, 'training'])->name('training');
    });

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class , 'index'])->name('dashboard');
        
        // Admin Profile
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

        Route::resource('categories', AdminCategoryController::class);
        Route::resource('brands', AdminBrandController::class);
        // Withdrawal Requests
        Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::post('/withdrawals/{withdrawalRequest}/approve', [WithdrawalController::class, 'approve'])->name('withdrawals.approve');
        Route::post('/withdrawals/{withdrawalRequest}/reject', [WithdrawalController::class, 'reject'])->name('withdrawals.reject');
        Route::resource('products', AdminProductController::class);
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
        Route::patch('orders/{order}/status', [AdminOrderController::class , 'updateStatus'])->name('orders.status.update');
        Route::post('orders/{order}/assign', [AdminOrderController::class , 'assignDelivery'])->name('orders.assign');
        // ---- Coupon Management ----
        Route::resource('coupons', CouponController::class);
        Route::post('/coupons/{coupon}/toggle', [CouponController::class , 'toggle'])
            ->name('coupons.toggle');

        Route::resource('ads', \App\Http\Controllers\Admin\AdController::class);

        Route::get('withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::post('withdrawals/{withdrawalRequest}/approve', [WithdrawalController::class, 'approve'])->name('withdrawals.approve');
        Route::post('withdrawals/{withdrawalRequest}/reject', [WithdrawalController::class, 'reject'])->name('withdrawals.reject');

        Route::get('support', [\App\Http\Controllers\Admin\SupportController::class, 'index'])->name('support.index');
        Route::post('support/{message}/read', [\App\Http\Controllers\Admin\SupportController::class, 'markAsRead'])->name('support.mark-read');
        Route::delete('support/{message}', [\App\Http\Controllers\Admin\SupportController::class, 'destroy'])->name('support.destroy');

        Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::post('settings/update', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');

        Route::get('logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('logs.index');

        Route::get('export/orders', [\App\Http\Controllers\Admin\ExportController::class, 'exportOrders'])->name('export.orders');
        Route::get('export/vendors', [\App\Http\Controllers\Admin\ExportController::class, 'exportVendors'])->name('export.vendors');


        Route::get('users', [AdminUserController::class , 'index'])->name('users.index');
        Route::get('users/create', [AdminUserController::class , 'create'])->name('users.create');
        Route::get('users/edit/{id}', [AdminUserController::class , 'edit'])->name('users.edit');
        Route::put('users/update/{id}', [AdminUserController::class , 'update'])->name('users.update');
        Route::delete('users/{user}', [AdminUserController::class , 'disableUser'])->name('users.destroy');
        Route::post('users/store', [AdminUserController::class , 'store'])->name('users.store');
        Route::get('users/{id}/restore', [AdminUserController::class , 'restore'])->name('users.restore');
        Route::delete('users/{id}/force-delete', [AdminUserController::class , 'forceDelete'])->name('users.forceDelete');
        
        // ---- Specialized User Management ----
        Route::get('vendors', [\App\Http\Controllers\Admin\VendorController::class, 'index'])->name('vendors.index');
        Route::get('vendors/{vendor}', [\App\Http\Controllers\Admin\VendorController::class, 'show'])->name('vendors.show');
        Route::post('vendors/{vendor}/approve', [\App\Http\Controllers\Admin\VendorController::class, 'approve'])->name('vendors.approve');
        Route::post('vendors/{vendor}/reject', [\App\Http\Controllers\Admin\VendorController::class, 'reject'])->name('vendors.reject');

        Route::get('delivery-boys', [\App\Http\Controllers\Admin\DeliveryBoyController::class, 'index'])->name('delivery-boys.index');
        Route::get('delivery-boys/{deliveryBoy}', [\App\Http\Controllers\Admin\DeliveryBoyController::class , 'show'])->name('delivery-boys.show');
        Route::post('delivery-boys/approve/{deliveryBoy}', [\App\Http\Controllers\Admin\DeliveryBoyController::class , 'approve'])->name('delivery-boys.approve');
        Route::post('delivery-boys/{deliveryBoy}/reject', [\App\Http\Controllers\Admin\DeliveryBoyController::class, 'reject'])->name('delivery-boys.reject');

        // ---- Marketplace Structure ----
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class);

        Route::get('/admin/search', [AdminSearchController::class , 'globalSearch'])->name('search');
        Route::get('/admin/notifications', function () {
            $recentUsers = User::where('created_at', '>=', now()->subHours(24))->latest()->get();
            $recentOrders = Order::where('status', 'pending')->latest()->get();
            $lowStockProducts = Product::where('stock_quantity', '<=', 5)->latest()->get();


            $totalCount = $recentUsers->count() + $recentOrders->count() + $lowStockProducts->count();
            //  return view('admin.notifications.index');
    
            return view('admin.notifications.index'
            , compact(
            'recentUsers',
            'recentOrders',
            'lowStockProducts',
            'totalCount'
            ));
        }
        )->name('notifications.index');

    });

require __DIR__ . '/auth.php';

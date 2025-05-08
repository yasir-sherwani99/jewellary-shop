<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|
| Guest Routes
|
*/
Route::get('/', [App\Http\Controllers\Guest\HomeController::class, 'index'])->name('home');
Route::get('contact', [App\Http\Controllers\Guest\ContactController::class, 'create'])->name('contact.create');
Route::post('contact', [App\Http\Controllers\Guest\ContactController::class, 'store'])->name('contact.store');

Route::get('product/{product:slug}', [App\Http\Controllers\Guest\ProductController::class, 'show'])->name('product.show');
Route::get('collections', [App\Http\Controllers\Guest\ProductController::class, 'getProductCollection'])->name('product.collection');
Route::get('collection/best-selling', [App\Http\Controllers\Guest\ProductController::class, 'getBestSellingCollection'])->name('product.best-selling');

Route::get('cart-page', [App\Http\Controllers\Guest\CartController::class, 'index'])->name('cart.index');
Route::prefix('cart')->group(function () {
    Route::post('/add', [App\Http\Controllers\Guest\CartController::class, 'add'])->name('cart.add');
    Route::post('/remove', [App\Http\Controllers\Guest\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/update', [App\Http\Controllers\Guest\CartController::class, 'update'])->name('cart.update');
    Route::get('/', [App\Http\Controllers\Guest\CartController::class, 'getCart'])->name('cart.get');
    Route::post('/clear', [App\Http\Controllers\Guest\CartController::class, 'clear'])->name('cart.clear');
});

Route::get('checkout', [App\Http\Controllers\Guest\CheckoutController::class, 'show'])->name('checkout.show');
Route::post('checkout', [App\Http\Controllers\Guest\CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::get('checkout/order-received', [App\Http\Controllers\Guest\CheckoutController::class, 'checkoutComplete'])->name('checkout.complete');

/*
|
| User Routes
|
*/
Auth::routes();
Route::middleware(['auth:web'])->group(function () { 
    Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('wishlists')->group(function () {
        Route::get('/', [App\Http\Controllers\User\WishlistController::class, 'show'])->name('wishlist.show');
        Route::post('/toggle', [App\Http\Controllers\User\WishlistController::class, 'toggle'])->name('wishlist.toggle');
        Route::post('/remove', [App\Http\Controllers\User\WishlistController::class, 'remove'])->name('wishlist.remove');
        // update user profile
		Route::put('profile/{user}', [App\Http\Controllers\User\ProfileController::class, 'updateUserProfile'])->name('user.update');
        Route::post('password', [App\Http\Controllers\User\ProfileController::class, 'changePassword'])->name('password.store');
    });
});

/*
|
| Admin Routes
|
*/
Route::prefix('admin')->group(function () {
    Route::middleware('guest-admin')->group(function() {
        Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm']);
        Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login.store');
    }); 
    Route::middleware('auth-admin')->group(function() {
        Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'getDashboard'])->name('admin.dashboard');
        Route::prefix('orders')->group(function () {
            Route::get('/new', [App\Http\Controllers\Admin\OrderController::class, 'new'])->name('admin.orders.new');
            Route::get('/getNewOrders', [App\Http\Controllers\Admin\OrderController::class, 'getNewOrders']);
            Route::get('/cancel', [App\Http\Controllers\Admin\OrderController::class, 'cancelOrReturned'])->name('admin.orders.cancel');
            Route::get('/getCancelOrReturnedOrders', [App\Http\Controllers\Admin\OrderController::class, 'getCancelOrReturnedOrders']);
            Route::get('/log', [App\Http\Controllers\Admin\OrderController::class, 'log'])->name('admin.orders.log');
        });
    });
});

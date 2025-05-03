<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|
| Guest Routes
|
*/
Route::get('/', [App\Http\Controllers\Guest\HomeController::class, 'index'])->name('home');
Route::get('product/{product:slug}', [App\Http\Controllers\Guest\ProductController::class, 'show'])->name('product.show');
Route::get('collections/{collection:slug}', [App\Http\Controllers\Guest\ProductController::class, 'getProductCollection'])->name('product.collection');
Route::get('shop', [App\Http\Controllers\Guest\ProductController::class, 'getShop']);

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

Route::middleware(['auth'])->group(function () { 
    Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('wishlists')->group(function () {
        Route::get('/', [App\Http\Controllers\User\WishlistController::class, 'show'])->name('wishlist.show');
        Route::post('/toggle', [App\Http\Controllers\User\WishlistController::class, 'toggle'])->name('wishlist.toggle');
        Route::post('/remove', [App\Http\Controllers\User\WishlistController::class, 'remove'])->name('wishlist.remove');
    });
});

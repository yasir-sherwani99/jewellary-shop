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
        // order
        Route::prefix('orders')->group(function () {
            Route::get('/new', [App\Http\Controllers\Admin\OrderController::class, 'new'])->name('admin.orders.new');
            Route::get('/getNewOrders', [App\Http\Controllers\Admin\OrderController::class, 'getNewOrders']);
            Route::get('/cancel', [App\Http\Controllers\Admin\OrderController::class, 'cancelOrReturned'])->name('admin.orders.cancel');
            Route::get('/getCancelOrReturnedOrders', [App\Http\Controllers\Admin\OrderController::class, 'getCancelOrReturnedOrders']);
            Route::get('/log', [App\Http\Controllers\Admin\OrderController::class, 'log'])->name('admin.orders.log');
            Route::get('/getOrdersLog', [App\Http\Controllers\Admin\OrderController::class, 'getOrdersLog']);
            Route::get('/{order}/details', [App\Http\Controllers\Admin\OrderController::class, 'details'])->name('admin.orders.details');
            Route::put('/{order}/details', [App\Http\Controllers\Admin\OrderController::class, 'process'])->name('admin.orders.process');
        });
        // products
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->names([
            'index'   => 'admin.products.index',
            'create'  => 'admin.products.create',
            'store'   => 'admin.products.store',
            'show'    => 'admin.products.show',
            'edit'    => 'admin.products.edit',
            'update'  => 'admin.products.update',
            'destroy' => 'admin.products.delete',
        ]);
        Route::get('getAllProducts', [App\Http\Controllers\Admin\ProductController::class, 'getAllProducts']);
        Route::delete('product-image/{image}', [App\Http\Controllers\Admin\ProductController::class, 'deleteProductImage']);
        // users 
        Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('getAllUsers', [App\Http\Controllers\Admin\UserController::class, 'getAllUsers']);
        // customer support
        Route::get('support', [App\Http\Controllers\Admin\SupportController::class, 'index'])->name('admin.support.index');
        Route::get('getNewMessages', [App\Http\Controllers\Admin\SupportController::class, 'getNewMessages']);
        Route::get('support/{support}', [App\Http\Controllers\Admin\SupportController::class, 'show'])->name('admin.support.show');
        Route::get('support-log', [App\Http\Controllers\Admin\SupportController::class, 'log'])->name('admin.support.log');
        Route::get('getAllMessages', [App\Http\Controllers\Admin\SupportController::class, 'getAllMessages']);
        // categories
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->names([
            'index'   => 'admin.categories.index',
            'create'  => 'admin.categories.create',
            'store'   => 'admin.categories.store',
            'show'    => 'admin.categories.show',
            'edit'    => 'admin.categories.edit',
            'update'  => 'admin.categories.update',
            'destroy' => 'admin.categories.delete',
        ]);
        Route::get('getAllCategories', [App\Http\Controllers\Admin\CategoryController::class, 'getAllCategories']);
        Route::get('categories/{category}/status', [App\Http\Controllers\Admin\CategoryController::class, 'changeStatus']);
        // admins
        Route::resource('admins', App\Http\Controllers\Admin\AdminController::class)->names([
            'index'   => 'admin.admins.index',
            'create'  => 'admin.admins.create',
            'store'   => 'admin.admins.store',
            'show'    => 'admin.admins.show',
            'edit'    => 'admin.admins.edit',
            'update'  => 'admin.admins.update',
            'destroy' => 'admin.admins.delete',
        ]);
        // shipping methods
        Route::resource('shipping-methods', App\Http\Controllers\Admin\ShippingMethodController::class)->names([
            'index'   => 'admin.shipping-methods.index',
            'create'  => 'admin.shipping-methods.create',
            'store'   => 'admin.shipping-methods.store',
            'show'    => 'admin.shipping-methods.show',
            'edit'    => 'admin.shipping-methods.edit',
            'update'  => 'admin.shipping-methods.update',
            'destroy' => 'admin.shipping-methods.delete',
        ]);
        Route::patch('/shipping-methods/{id}/toggle', [App\Http\Controllers\Admin\ShippingMethodController::class, 'toggle'])->name('admin.shipping-methods.toggle');
        // tax rate
        Route::resource('tax-rates', App\Http\Controllers\Admin\TaxRateController::class)->names([
            'index'   => 'admin.tax-rates.index',
            'create'  => 'admin.tax-rates.create',
            'store'   => 'admin.tax-rates.store',
            'show'    => 'admin.tax-rates.show',
            'edit'    => 'admin.tax-rates.edit',
            'update'  => 'admin.tax-rates.update',
            'destroy' => 'admin.tax-rates.delete',
        ]);
        Route::patch('/tax-rates/{id}/toggle', [App\Http\Controllers\Admin\TaxRateController::class, 'toggle'])->name('admin.tax-rates.toggle');
        // password
        Route::get('password', [App\Http\Controllers\Admin\PasswordController::class, 'create'])->name('admin.password.create');
        Route::post('password', [App\Http\Controllers\Admin\PasswordController::class, 'store'])->name('admin.password.store');
    });
});

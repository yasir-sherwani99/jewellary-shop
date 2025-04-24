<?php

use Illuminate\Support\Facades\Route;

/*
|
| Guest Routes
|
*/
Route::get('/', [App\Http\Controllers\Guest\HomeController::class, 'index']);
Route::get('product', [App\Http\Controllers\Guest\ProductController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes([
    'reset' => false,
    'confirm' => false
]);

Route::middleware('auth')->group(function () {
    Route::middleware('is_admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::get('orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('orders', [\App\Http\Controllers\User\UserController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [\App\Http\Controllers\User\UserController::class, 'show'])->name('orders.show');
    });
});

Route::get('/', [\App\Http\Controllers\Shop\ProductController::class, 'index'])->name('home');
Route::get('product/{slug}', [\App\Http\Controllers\Shop\ProductController::class, 'show'])->name('shop.products.show');
Route::get('/categories', [\App\Http\Controllers\Shop\CategoryController::class, 'index'])->name('shop.categories.index');
Route::get('category/{slug}', [\App\Http\Controllers\Shop\CategoryController::class, 'show'])->name('shop.categories.show');

Route::middleware('user_cart')->group(function () {
    Route::get('/cart', [\App\Http\Controllers\Shop\CartController::class, 'cart'])->name('cart');
    Route::post('/cart/add/{product}', [\App\Http\Controllers\Shop\CartController::class, 'addToCart'])->name('add_to_cart');
    Route::post('/cart/remove/{product}', [\App\Http\Controllers\Shop\CartController::class, 'removeFromCart'])->name('remove_from_cart');
    Route::get('/order', [\App\Http\Controllers\Shop\CartController::class, 'order'])->name('order');
    Route::post('/order', [\App\Http\Controllers\Shop\CartController::class, 'orderPost'])->name('order_post');
});








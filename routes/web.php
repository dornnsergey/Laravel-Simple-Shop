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

Route::middleware('is_admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'is_admin']);

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('index');
Route::get('/categories', [\App\Http\Controllers\MainController::class, 'categories'])->name('categories');
Route::get('/cart', [\App\Http\Controllers\ShoppingCartController::class, 'cart'])->name('cart');
Route::post('/cart/add/{product}', [\App\Http\Controllers\ShoppingCartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/cart/remove/{product}', [\App\Http\Controllers\ShoppingCartController::class, 'removeFromCart'])->name('remove-from-cart');
Route::get('/order', [\App\Http\Controllers\ShoppingCartController::class, 'order'])->name('order');
Route::post('/order', [\App\Http\Controllers\ShoppingCartController::class, 'orderPost'])->name('order-post');
Route::get('/{category}', [\App\Http\Controllers\MainController::class, 'category'])->name('category');
Route::get('/{category}/{product?}', [\App\Http\Controllers\MainController::class, 'product'])->name('product');






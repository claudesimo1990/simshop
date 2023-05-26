<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;
use App\Http\Controllers\Shop\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductsController::class, 'index'])->name('welcome');


Route::get('/cart/product/{product:slug}/show', [CartController::class, 'show'])->name('cart.product.show');
Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.product.add');
Route::get('/cart', [CartController::class, 'cartList'])->name('cart.list');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.create');
    Route::post('/checkout', [CartController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/failed', [CartController::class, 'failed'])->name('checkout.failed');
});

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

//Route::get('/search', 'ShopController@search')->name('search');
//Route::get('/search-algolia', 'ShopController@searchAlgolia')->name('search-algolia');

//Route::middleware('auth')->group(function () {
//    Route::get('/my-profile', 'UsersController@edit')->name('users.edit');
//    Route::patch('/my-profile', 'UsersController@update')->name('users.update');
//
//    Route::get('/my-orders', 'OrdersController@index')->name('orders.index');
//    Route::get('/my-orders/{order}', 'OrdersController@show')->name('orders.show');
//});

require __DIR__.'/auth.php';

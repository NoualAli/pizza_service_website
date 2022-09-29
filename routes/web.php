<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Website\RestaurantController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\MenuController;
use App\Http\Controllers\Website\OrderController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

define('USER_DEFAULT_LOCATION', \Location::get(getIp()));

Route::get('test', function () {
    return view('test');
});

Route::get('home', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('terms-and-conditions', fn () => view('website.pages.terms_conditions'))->name('terms_and_conditions');
Route::get('privacy-policy', fn () => view('website.pages.privary_policy'))->name('privacy_policy');
Route::get('about-us', fn () => view('website.pages.about'))->name('about_us');
Route::get('restaurants', [RestaurantController::class, 'index'])->name('restaurants.list');
Route::get('restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.single');
Route::get('menus', [MenuController::class, 'index'])->name('menus.list');

/**
 * Cart
 */
Route::get('cart-index', [CartController::class, 'index']);

/**
 * Cart checkout
 */
Route::post('cart-checkout', [CartController::class, 'checkout']);

/**
 * Orders
 */

Route::group([
    'prefix'     => config('backpack.base.custom_prefixes.ps', 'ps'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
], function () {
    Route::get('update-order-state', [OrderController::class, 'updateState'])->name('orders.update');
});

Route::group(['prefix' => 'checkout'], function () {
    Route::get('stripe/success', function () {
        $order = Order::findOrFail(request()->order_id);
        return view('website.pages.checkout.success', compact('order'));
    });
});
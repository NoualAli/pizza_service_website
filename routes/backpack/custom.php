<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('restaurant', 'RestaurantCrudController');
    Route::crud('menu', 'MenuCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('ingredient', 'IngredientCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('extra', 'ExtraCrudController');
});

Route::group([
    'prefix'     => config('backpack.base.custom_prefixes.ps', 'ps'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        // (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    Route::crud('order', 'OrderCrudController');
    Route::crud('order-lines', 'OrderLinesCrudController');
});
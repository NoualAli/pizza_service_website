<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientLocationController;
use App\Http\Controllers\Api\OrderTypeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RestaurantController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * Restaurant
 */
Route::group([
    'prefix' => 'restaurants'
], function () {
    Route::get('/', [RestaurantController::class, 'index']);
    Route::get('{restaurant_id}', [RestaurantController::class, 'show']);
    Route::get('fetch/current', [RestaurantController::class, 'current']);
});

/**
 * Client location
 */
Route::group([
    'prefix' => 'client-location'
], function () {
    Route::post('/', [ClientLocationController::class, 'set']);
    Route::get('/', [ClientLocationController::class, 'get']);
});

/**
 * Categories
 */
Route::get('categories', [CategoryController::class, 'index']);

/**
 * Products
 */
Route::get('products/{product}', [ProductController::class, 'single']);

/**
 * Cart
 */

Route::group([
    'prefix' => 'cart',
    'name' => 'cart.'
], function () {
    Route::get('/', [CartController::class, 'cart']);
    Route::post('/', [CartController::class, 'add']);
    Route::delete('/', [CartController::class, 'destroy']);
    Route::put('/', [CartController::class, 'update']);
});

/**
 * Order type
 */
Route::group([
    'prefix' => 'order-type',
], function () {
    Route::post('/', [OrderTypeController::class, 'set']);
    Route::get('/', [OrderTypeController::class, 'get']);
});
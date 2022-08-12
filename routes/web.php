<?php

use App\Http\Controllers\Website\RestaurantController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\MenuController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('restaurants', [RestaurantController::class, 'index'])->name('restaurants.list');
Route::get('restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.single');
Route::get('menus', [MenuController::class, 'index'])->name('menus.list');
<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Jackiedo\Cart\Facades\Cart;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website.pages.restaurants');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        if (!session('current-restaurant')) {
            session(['current-restaurant' => $restaurant]);
        } else {
            if (session('current-restaurant')?->id !== $restaurant->id) {
                Cart::name('order-cart')->destroy();
                session(['current-restaurant' => $restaurant]);
            }
        }
        $restaurant->load(['products', 'menus']);
        return view('website.pages.restaurant', compact('restaurant'));
    }
}
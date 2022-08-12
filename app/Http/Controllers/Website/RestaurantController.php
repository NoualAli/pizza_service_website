<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        $menus = Menu::all();

        // return view('website.pages.restaurants_map_list', compact('restaurants', 'menus'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        dd($restaurant, $restaurant->menus, $restaurant->locations, $restaurant->users, $restaurant->contacts);
    }
}
<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $restaurants = cache()->rememberForever('home_restaurants_list', fn () => Restaurant::limit(6)->get());
        // $menus = cache()->rememberForever('home_menus_list', fn () => Menu::limit(6)->get());
        // return view('website.pages.home', compact('restaurants', 'menus'));
    }
}
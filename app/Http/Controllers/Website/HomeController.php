<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $restaurants = cache()->rememberForever('home_restaurants_list', fn () => RestaurantResource::collection(Restaurant::limit(6)->get()));
        $categories = cache()->rememberForever('categories_list', fn () => CategoryResource::collection(Category::all()));
        return view('website.pages.home', compact('restaurants', 'categories'));
    }
}
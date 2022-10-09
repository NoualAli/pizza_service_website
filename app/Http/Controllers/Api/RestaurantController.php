<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RestaurantController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $restaurants = Restaurant::nearest();

        if ($request->has('category_id')) {
            $restaurants = $restaurants->whereRelation('categories', 'category_id', $request->category_id);
        }
        if ($request->has('order_type')) {
            $restaurants = $restaurants->where($request->order_type, true);
        }

        if (Route::currentRouteName() !== "restaurants.list") {
            $restaurants = $restaurants->limit(4);
        }
        $restaurants->orderBy('distance');

        return response()->json([
            'restaurants' => RestaurantResource::collection($restaurants->get())
        ]);
    }
    /**
     * @param int $restaurant_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id)->load(['menus', 'products']);
        $products = ProductResource::collection($restaurant->products);
        return response()->json(compact('restaurant', 'products'));
    }


    /**
     * Fetch current restaurant
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function current()
    {
        return response()->json([
            'current_restaurant' => session()->get('current-restaurant')
        ]);
    }
    // public function filter(Request $request, Restaurant $restaurant)
    // {
    //     $orders = $restaurant->orders();
    //     foreach ($request->all() as $key => $value) {
    //         $orders = $orders->where($key, $value);
    //     }
    //     return response()->json([
    //         'orders' => OrderResource::collection($orders->get())
    //     ]);
    // }
}
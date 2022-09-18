<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('category_id')) {
            $restaurants = Restaurant::nearest()->whereRelation('categories', 'category_id', $request->category_id);
        } else {
            $restaurants = Restaurant::nearest();
        }

        if (session()->has('order_type') || request()->has('order_type')) {
            $restaurants = $this->filterByType($restaurants);
            return response()->json([
                'restaurants' => RestaurantResource::collection($restaurants)
            ]);
        }
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

    public function filter(Request $request, Restaurant $restaurant)
    {
        $orders = $restaurant->orders();
        foreach ($request->all() as $key => $value) {
            $orders = $orders->where($key, $value);
        }
        return response()->json([
            'orders' => OrderResource::collection($orders->get())
        ]);
    }

    /**
     * @param Illuminate\Database\Eloquent\Builder  $restaurants
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    private function filterByType(Builder $restaurants)
    {
        $type = request()->order_type ?: session('order_type');
        $type = ucfirst(strtolower($type));
        return $restaurants->get()->filter(function ($restaurant) use ($type) {
            $types = json_decode($restaurant->order_types, true);
            if (count($types)) {
                return $types[0][$type];
            }
            return;
        });
    }
}
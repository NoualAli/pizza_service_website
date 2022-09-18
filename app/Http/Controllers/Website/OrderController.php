<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderLineResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $restaurants = $user->restaurants->load('orders');
        return view('website.pages.orders.index', compact('user', 'restaurants'));
    }

    public function order(Order $order)
    {
        return response()->json([
            'order' => $order,
            'lines' => OrderLineResource::collection($order->lines)
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restaurant(Request $request)
    {
        $restaurant = Restaurant::findOrFail($request->restaurant)->load('orders');
        return response()->json([
            'restaurant' => $restaurant,
            'orders' => OrderResource::collection($restaurant->orders()->orderBy('created_at', 'desc')->get())
        ]);
    }

    public function delete(Order $order)
    {
        if ($order->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Command #' . $order->id . ' has been successfully deleted'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while trying to delete command #' . $order->id . ', please try again later'
        ]);
    }

    /**
     * Update order state
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateState(Request $request)
    {
        // dd($request->all());
        $order = Order::findOrFail($request->order_id);
        $order->state = $request->state;
        $order->save();
        Alert::success('Order #' . $order->id . ' succesfully updated')->flash();
        return redirect()->back();
        // return response()->json([
        //     'restaurant_id' => $order->restaurant_id,
        //     'succes' => true,
        //     'message' => 'Order state successfully updated'
        // ]);
    }
}
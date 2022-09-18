<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderTypeController extends Controller
{
    public function set(Request $request)
    {
        if ($request->has('order_type') && $request->order_type !== null) {
            session(['order_type' => $request->order_type]);
            return $request->order_type;
        }
        session()->remove('order_type');
    }

    public function get()
    {
        return session('order_type');
    }
}
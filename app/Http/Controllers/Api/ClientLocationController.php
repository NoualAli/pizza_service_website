<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ClientLocationController extends Controller
{
    public function set(Request $request)
    {
        session()->remove('location');
        $location = $request->location;
        if ($location) {
            $data = [];
            foreach ($location as $key => $value) {
                $data['location'][$key] = $value;
            }
            session($data);
        }
        $location = session('location');
        return Restaurant::nearest()->get()->count();
    }

    public function get()
    {
        return getUserCoords();
    }
}
<?php

use Jackiedo\Cart\Facades\Cart;

if (!function_exists('getIp')) {
    function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}

if (!function_exists('getUserCoords')) {
    function getUserCoords()
    {
        if (!session()->has('location')) {
            $location = USER_DEFAULT_LOCATION;
            if ($location) {
                session(['location' => [
                    // 'street_address' => $location?->city,
                    'longitude' => $location->longitude,
                    'latitude' => $location->latitude,
                ]]);
            } else {
                session(['location' => [
                    'street_address' => 'Helsinki Finland',
                    'longitude' => 24.7385104,
                    'latitude' => 60.11021,
                ]]);
            }
        }
        $location = session('location');
        return $location;
    }
}

if (!function_exists('getCart')) {
    function getCart()
    {
        return Cart::name('ps-cart')->getDetails();
    }
}

if (!function_exists('MonthsList')) {
    /**
     * Months List
     *
     * @return array
     */
    function monthsList()
    {
        return ['01' => __('January'), '02' => __('February'), '03' => __('March'), '04' => __('April'), '05' => __('May'), '06' => __('June'), '07' => __('July'), '08' => __('August'), '09' => __('September'), '10' => __('Octeber'), '11' => __('November'), '12' => __('Decemeber')];
    }
}
<?php

namespace App\Observers;

use App\Models\Restaurant;

class RestaurantObserver
{
    /**
     * Handle the Restaurant "created" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function created(Restaurant $restaurant)
    {
        $this->refreshCache();
    }

    /**
     * Handle the Restaurant "updated" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function updated(Restaurant $restaurant)
    {
        $this->refreshCache();
    }

    /**
     * Handle the Restaurant "deleted" event.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return void
     */
    public function deleted(Restaurant $restaurant)
    {
        $this->refreshCache();
    }

    private function refreshCache()
    {
        cache()->forget('home_restaurants_list');
        cache()->rememberForever('home_restaurants_list', fn () => Restaurant::limit(6)->get());
    }
}
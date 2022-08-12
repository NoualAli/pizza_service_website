<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RestaurantsMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('restaurants_menus')->delete();
        
        \DB::table('restaurants_menus')->insert(array (
            0 => 
            array (
                'restaurant_id' => 1,
                'menu_id' => 1,
            ),
            1 => 
            array (
                'restaurant_id' => 3,
                'menu_id' => 1,
            ),
            2 => 
            array (
                'restaurant_id' => 4,
                'menu_id' => 1,
            ),
            3 => 
            array (
                'restaurant_id' => 5,
                'menu_id' => 1,
            ),
            4 => 
            array (
                'restaurant_id' => 1,
                'menu_id' => 2,
            ),
            5 => 
            array (
                'restaurant_id' => 2,
                'menu_id' => 2,
            ),
            6 => 
            array (
                'restaurant_id' => 4,
                'menu_id' => 3,
            ),
            7 => 
            array (
                'restaurant_id' => 3,
                'menu_id' => 4,
            ),
            8 => 
            array (
                'restaurant_id' => 3,
                'menu_id' => 5,
            ),
            9 => 
            array (
                'restaurant_id' => 5,
                'menu_id' => 6,
            ),
            10 => 
            array (
                'restaurant_id' => 5,
                'menu_id' => 7,
            ),
            11 => 
            array (
                'restaurant_id' => 4,
                'menu_id' => 8,
            ),
        ));
        
        
    }
}
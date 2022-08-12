<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RestaurantsCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('restaurants_categories')->delete();
        
        \DB::table('restaurants_categories')->insert(array (
            0 => 
            array (
                'restaurant_id' => 1,
                'category_id' => 1,
            ),
            1 => 
            array (
                'restaurant_id' => 3,
                'category_id' => 1,
            ),
            2 => 
            array (
                'restaurant_id' => 4,
                'category_id' => 1,
            ),
            3 => 
            array (
                'restaurant_id' => 5,
                'category_id' => 1,
            ),
            4 => 
            array (
                'restaurant_id' => 1,
                'category_id' => 2,
            ),
            5 => 
            array (
                'restaurant_id' => 2,
                'category_id' => 2,
            ),
            6 => 
            array (
                'restaurant_id' => 3,
                'category_id' => 3,
            ),
            7 => 
            array (
                'restaurant_id' => 5,
                'category_id' => 3,
            ),
            8 => 
            array (
                'restaurant_id' => 4,
                'category_id' => 4,
            ),
        ));
        
        
    }
}
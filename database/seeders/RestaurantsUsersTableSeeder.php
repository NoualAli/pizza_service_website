<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RestaurantsUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('restaurants_users')->delete();
        
        \DB::table('restaurants_users')->insert(array (
            0 => 
            array (
                'restaurant_id' => 5,
                'user_id' => 1,
            ),
            1 => 
            array (
                'restaurant_id' => 4,
                'user_id' => 1,
            ),
            2 => 
            array (
                'restaurant_id' => 3,
                'user_id' => 1,
            ),
            3 => 
            array (
                'restaurant_id' => 2,
                'user_id' => 1,
            ),
            4 => 
            array (
                'restaurant_id' => 1,
                'user_id' => 1,
            ),
        ));
        
        
    }
}
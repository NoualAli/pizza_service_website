<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RestaurantLocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('restaurant_locations')->delete();
        
        \DB::table('restaurant_locations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'restaurant_id' => 5,
                'address' => 'Albertinkatu 36, 00180 Helsinki, Finlande',
            ),
            1 => 
            array (
                'id' => 2,
                'restaurant_id' => 4,
                'address' => 'Kirkkotie 15, Kauniainen, Etelä-Suomi, Finlande',
            ),
            2 => 
            array (
                'id' => 3,
                'restaurant_id' => 3,
                'address' => 'Espoon keskus, Espoo, Etelä-Suomi, Finlande',
            ),
            3 => 
            array (
                'id' => 4,
                'restaurant_id' => 2,
                'address' => 'Laukkarinne 4, Vantaa, Etelä-Suomi, Finlande',
            ),
            4 => 
            array (
                'id' => 5,
                'restaurant_id' => 1,
                'address' => 'Laukkarinne 4, Vantaa, Etelä-Suomi, Finlande',
            ),
        ));
        
        
    }
}
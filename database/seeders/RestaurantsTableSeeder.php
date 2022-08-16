<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('restaurants')->delete();

        \DB::table('restaurants')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Pizza Service Hakunila',
                'description' => NULL,
                'thumbnail' => 'uploads/404a016d7e6537b31c020e371ed2bd39.jpg',
                'opening' => '01:05:00',
                'closing' => '23:31:00',
                'minimum_order' => 10.0,
                'address' => 'Laukkarinne 4, Vantaa, Etelä-Suomi, Finlande',
                'longitude' => 60.2785269,
                'latitude' => 25.1051532,
                'created_at' => '2022-08-07 20:14:09',
                'updated_at' => '2022-08-11 21:05:35',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Hakunila Shish Kebab',
                'description' => NULL,
                'thumbnail' => 'uploads/a6cd9f36a9d6f683a10b1633fdf807d7.jpg',
                'opening' => '10:00:00',
                'closing' => '20:30:00',
                'minimum_order' => 20.0,
                'address' => 'Laukkarinne 4, Vantaa, Etelä-Suomi, Finlande',
                'longitude' => 60.2785269,
                'latitude' => 25.1051532,
                'created_at' => '2022-08-09 10:04:43',
                'updated_at' => '2022-08-11 21:05:14',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Pizza Service Espoon Keskus',
                'description' => NULL,
                'thumbnail' => NULL,
                'opening' => '10:00:00',
                'closing' => '00:00:00',
                'minimum_order' => 15.0,
                'address' => 'Espoon keskus, Espoo, Etelä-Suomi, Finlande',
                'longitude' => 60.2048369,
                'latitude' => 24.6536222,
                'created_at' => '2022-08-09 10:07:44',
                'updated_at' => '2022-08-11 21:04:51',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'Pizza Service Kauniainen',
                'description' => NULL,
                'thumbnail' => 'uploads/0ac4b406b5848d8cf4a9668850d344d3.jpg',
                'opening' => '10:00:00',
                'closing' => '21:45:00',
                'minimum_order' => 20.0,
                'address' => 'Kirkkotie 15, Kauniainen, Etelä-Suomi, Finlande',
                'longitude' => 60.2097627,
                'latitude' => 24.7269947,
                'created_at' => '2022-08-09 10:10:27',
                'updated_at' => '2022-08-11 21:04:19',
            ),
            4 =>
            array(
                'id' => 5,
                'name' => 'Pizza Service Kamppi',
                'description' => NULL,
                'thumbnail' => 'uploads/5a665e70140f512dd6112bbb7c9a98cf.jpg',
                'opening' => '10:00:00',
                'closing' => '22:00:00',
                'minimum_order' => 15.0,
                'address' => 'Albertinkatu 36, 00180 Helsinki, Finlande',
                'longitude' => 60.1646125,
                'latitude' => 24.9326533,
                'created_at' => '2022-08-09 10:11:45',
                'updated_at' => '2022-08-11 21:11:46',
            ),
        ));
    }
}
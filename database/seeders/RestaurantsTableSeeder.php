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
        
        \DB::table('restaurants')->insert(array (
            0 => 
            array (
                'address' => 'Laukkarinne 4, 01200 Vantaa, Finland',
                'cover' => 'uploads/404a016d7e6537b31c020e371ed2bd39.jpg',
                'created_at' => '2022-08-07 20:14:09',
                'deleted_at' => NULL,
                'delivery_fee' => 0.0,
                'delivery_time' => 60,
                'discount' => 0.0,
                'email' => NULL,
                'id' => 1,
                'latitude' => 60.2785269,
                'longitude' => 25.1051532,
                'minimum_order' => 10.0,
                'name' => 'Pizza Service Hakunila',
                'order_types' => '[{"Pickup": true, "Delivery": true, "On the spot": true}]',
                'phone' => '0505432727',
                'slug' => 'pizza-service-hakunila',
                'time_slots' => '[{"closing": "22:00", "opening": "10:00", "week_day": "Monday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Tuesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Wednesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Thursday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Friday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Saturday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Sunday"}]',
                'updated_at' => '2022-08-11 21:05:35',
            ),
            1 => 
            array (
                'address' => 'Laukkarinne 4, Vantaa, Etelä-Suomi, Finlande',
                'cover' => 'uploads/a6cd9f36a9d6f683a10b1633fdf807d7.jpg',
                'created_at' => '2022-08-09 10:04:43',
                'deleted_at' => NULL,
                'delivery_fee' => 0.0,
                'delivery_time' => 60,
                'discount' => 0.0,
                'email' => NULL,
                'id' => 2,
                'latitude' => 60.2785269,
                'longitude' => 25.1051532,
                'minimum_order' => 20.0,
                'name' => 'Hakunila Shish Kebab',
                'order_types' => '[{"Pickup": true, "Delivery": true, "On the spot": true}]',
                'phone' => '0505432727',
                'slug' => 'hakunila-shish-kebab',
                'time_slots' => '[{"closing": "22:00", "opening": "10:00", "week_day": "Monday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Tuesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Wednesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Thursday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Friday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Saturday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Sunday"}]',
                'updated_at' => '2022-08-11 21:05:14',
            ),
            2 => 
            array (
                'address' => 'Saarniraiviontie 1, 02770 Espoo, Suomi',
                'cover' => NULL,
                'created_at' => '2022-08-09 10:07:44',
                'deleted_at' => NULL,
                'delivery_fee' => 0.0,
                'delivery_time' => 60,
                'discount' => 0.0,
                'email' => NULL,
                'id' => 3,
                'latitude' => 60.2048369,
                'longitude' => 24.6536222,
                'minimum_order' => 15.0,
                'name' => 'Pizza Service Espoon Keskus',
                'order_types' => '[{"Pickup": true, "Delivery": true, "On the spot": true}]',
                'phone' => '0505432727',
                'slug' => 'pizza-service-espoon-keskus',
                'time_slots' => '[{"closing": "22:00", "opening": "10:00", "week_day": "Monday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Tuesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Wednesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Thursday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Friday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Saturday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Sunday"}]',
                'updated_at' => '2022-08-11 21:04:51',
            ),
            3 => 
            array (
                'address' => 'Kirkkotie 15, Kauniainen, Etelä-Suomi, Finlande',
                'cover' => 'uploads/0ac4b406b5848d8cf4a9668850d344d3.jpg',
                'created_at' => '2022-08-09 10:10:27',
                'deleted_at' => NULL,
                'delivery_fee' => 0.0,
                'delivery_time' => 60,
                'discount' => 0.0,
                'email' => NULL,
                'id' => 4,
                'latitude' => 60.2097627,
                'longitude' => 24.7269947,
                'minimum_order' => 20.0,
                'name' => 'Pizza Service Kauniainen',
                'order_types' => '[{"Pickup": true, "Delivery": true, "On the spot": true}]',
                'phone' => '0505432727',
                'slug' => 'pizza-service-kauniainen',
                'time_slots' => '[{"closing": "22:00", "opening": "10:00", "week_day": "Monday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Tuesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Wednesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Thursday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Friday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Saturday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Sunday"}]',
                'updated_at' => '2022-08-11 21:04:19',
            ),
            4 => 
            array (
                'address' => 'Albertinkatu 36, 00180 Helsinki, Suomi',
                'cover' => 'uploads/5a665e70140f512dd6112bbb7c9a98cf.jpg',
                'created_at' => '2022-08-09 10:11:45',
                'deleted_at' => NULL,
                'delivery_fee' => 0.0,
                'delivery_time' => 60,
                'discount' => 0.0,
                'email' => NULL,
                'id' => 5,
                'latitude' => 60.1646125,
                'longitude' => 24.9326533,
                'minimum_order' => 15.0,
                'name' => 'Pizza Service Kamppi',
                'order_types' => '[{"Pickup": true, "Delivery": true, "On the spot": true}]',
                'phone' => '0505432727',
                'slug' => 'pizza-service-kamppi',
                'time_slots' => '[{"closing": "22:00", "opening": "10:00", "week_day": "Monday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Tuesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Wednesday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Thursday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Friday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Saturday"}, {"closing": "22:00", "opening": "10:00", "week_day": "Sunday"}]',
                'updated_at' => '2022-09-05 14:38:05',
            ),
        ));
        
        
    }
}
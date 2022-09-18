<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'restaurant_id' => 5,
                'client_lastname' => 'test',
                'client_firstname' => 'test',
                'client_address' => NULL,
                'client_phone' => NULL,
                'order_type' => 'pickup',
                'items_subtotal' => '11.00',
                'total' => '11.00',
                'created_at' => '2022-08-22 17:11:28',
                'updated_at' => '2022-08-22 17:11:28',
            ),
            1 => 
            array (
                'id' => 2,
                'restaurant_id' => 5,
                'client_lastname' => 'test',
                'client_firstname' => 'test',
                'client_address' => NULL,
                'client_phone' => NULL,
                'order_type' => 'pickup',
                'items_subtotal' => '22.40',
                'total' => '22.40',
                'created_at' => '2022-08-22 17:21:02',
                'updated_at' => '2022-08-22 17:21:02',
            ),
            2 => 
            array (
                'id' => 3,
                'restaurant_id' => 5,
                'client_lastname' => 'Noual',
                'client_firstname' => 'Ali',
                'client_address' => 'test',
                'client_phone' => NULL,
                'order_type' => 'delivery',
                'items_subtotal' => '22.40',
                'total' => '22.40',
                'created_at' => '2022-08-22 17:21:42',
                'updated_at' => '2022-08-22 17:21:42',
            ),
            3 => 
            array (
                'id' => 4,
                'restaurant_id' => 5,
                'client_lastname' => 'Noual',
                'client_firstname' => 'Ali',
                'client_address' => NULL,
                'client_phone' => NULL,
                'order_type' => 'pickup',
                'items_subtotal' => '11.40',
                'total' => '11.40',
                'created_at' => '2022-08-22 17:24:56',
                'updated_at' => '2022-08-22 17:24:56',
            ),
            4 => 
            array (
                'id' => 5,
                'restaurant_id' => 5,
                'client_lastname' => 'test',
                'client_firstname' => 'test',
                'client_address' => 'test',
                'client_phone' => NULL,
                'order_type' => 'delivery',
                'items_subtotal' => '11.40',
                'total' => '11.40',
                'created_at' => '2022-08-22 17:26:29',
                'updated_at' => '2022-08-22 17:26:29',
            ),
            5 => 
            array (
                'id' => 6,
                'restaurant_id' => 5,
                'client_lastname' => 'Test',
                'client_firstname' => 'test',
                'client_address' => NULL,
                'client_phone' => NULL,
                'order_type' => 'pickup',
                'items_subtotal' => '22.40',
                'total' => '22.40',
                'created_at' => '2022-08-22 17:52:02',
                'updated_at' => '2022-08-22 17:52:02',
            ),
            6 => 
            array (
                'id' => 7,
                'restaurant_id' => 5,
                'client_lastname' => 'test',
                'client_firstname' => 'test',
                'client_address' => 'test',
                'client_phone' => NULL,
                'order_type' => 'delivery',
                'items_subtotal' => '39.00',
                'total' => '39.00',
                'created_at' => '2022-08-22 18:45:59',
                'updated_at' => '2022-08-22 18:45:59',
            ),
        ));
        
        
    }
}
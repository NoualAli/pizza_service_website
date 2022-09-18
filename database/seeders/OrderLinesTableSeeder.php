<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderLinesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_lines')->delete();
        
        \DB::table('order_lines')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_id' => 1,
                'product_id' => 1,
                'total_price' => '11',
                'quantity' => 1,
                'extra' => '[]',
                'size' => 'normal',
                'subtotal' => '11.00',
            ),
            1 => 
            array (
                'id' => 2,
                'order_id' => 2,
                'product_id' => 1,
                'total_price' => '11',
                'quantity' => 1,
                'extra' => '[]',
                'size' => 'normal',
                'subtotal' => '11.00',
            ),
            2 => 
            array (
                'id' => 3,
                'order_id' => 2,
                'product_id' => 2,
                'total_price' => '11.4',
                'quantity' => 1,
                'extra' => '[]',
                'size' => 'normal',
                'subtotal' => '11.40',
            ),
            3 => 
            array (
                'id' => 4,
                'order_id' => 3,
                'product_id' => 2,
                'total_price' => '11.4',
                'quantity' => 1,
                'extra' => '[]',
                'size' => 'normal',
                'subtotal' => '11.40',
            ),
            4 => 
            array (
                'id' => 5,
                'order_id' => 3,
                'product_id' => 1,
                'total_price' => '11',
                'quantity' => 1,
                'extra' => '[]',
                'size' => 'normal',
                'subtotal' => '11.00',
            ),
            5 => 
            array (
                'id' => 6,
                'order_id' => 4,
                'product_id' => 2,
                'total_price' => '11.4',
                'quantity' => 1,
                'extra' => '[]',
                'size' => 'normal',
                'subtotal' => '11.40',
            ),
            6 => 
            array (
                'id' => 7,
                'order_id' => 5,
                'product_id' => 2,
                'total_price' => '11.4',
                'quantity' => 1,
                'extra' => '[]',
                'size' => 'normal',
                'subtotal' => '11.40',
            ),
            7 => 
            array (
                'id' => 8,
                'order_id' => 6,
                'product_id' => 2,
                'total_price' => '11.4',
                'quantity' => 1,
                'extra' => '[]',
                'size' => 'normal',
                'subtotal' => '11.40',
            ),
            8 => 
            array (
                'id' => 9,
                'order_id' => 6,
                'product_id' => 1,
                'total_price' => '11',
                'quantity' => 1,
                'extra' => '[]',
                'size' => 'normal',
                'subtotal' => '11.00',
            ),
            9 => 
            array (
                'id' => 10,
                'order_id' => 7,
                'product_id' => 1,
                'total_price' => '25',
                'quantity' => 2,
                'extra' => '{"Sinappi": 1, "Majoneesi": 0.5}',
                'size' => 'normal',
                'subtotal' => '25.00',
            ),
            10 => 
            array (
                'id' => 11,
                'order_id' => 7,
                'product_id' => 1,
                'total_price' => '14',
                'quantity' => 1,
                'extra' => '{"Sinappi": 1}',
                'size' => 'large',
                'subtotal' => '14.00',
            ),
        ));
        
        
    }
}
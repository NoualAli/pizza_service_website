<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductExtrasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_extras')->delete();
        
        \DB::table('product_extras')->insert(array (
            0 => 
            array (
                'extra_id' => 1,
                'product_id' => 1,
            ),
        ));
        
        
    }
}
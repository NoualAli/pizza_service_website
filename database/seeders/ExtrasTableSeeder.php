<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExtrasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('extras')->delete();
        
        \DB::table('extras')->insert(array (
            0 => 
            array (
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Test',
                'price' => '0.50',
            ),
        ));
        
        
    }
}
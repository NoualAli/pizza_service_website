<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Pizzat',
                'thumbnail' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Grill',
                'thumbnail' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Kebabit',
                'thumbnail' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Pastat',
                'thumbnail' => NULL,
            ),
        ));
        
        
    }
}
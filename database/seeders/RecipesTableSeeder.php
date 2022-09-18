<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('recipes')->delete();
        
        \DB::table('recipes')->insert(array (
            0 => 
            array (
                'product_id' => 1,
                'ingredient_id' => 58,
            ),
            1 => 
            array (
                'product_id' => 1,
                'ingredient_id' => 59,
            ),
        ));
        
        
    }
}
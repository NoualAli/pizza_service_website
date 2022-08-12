<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Pizzat',
                'thumbnail' => 'uploads/47de1d2b64ac9f0ab7c7072b6210740a.jpg',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Grill',
                'thumbnail' => 'uploads/1d37e4121ced98778b8271f2e7c4f2fc.jpg',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Pastat',
                'thumbnail' => 'uploads/46b2e4914e0b88187bf4f79ed2dce69a.jpg',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Vegaanipizzat',
                'thumbnail' => 'uploads/cab335f708434e1d2b3b1f5b938aeb29.jpg',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Kebabit Ja Kana',
                'thumbnail' => 'uploads/680175e053377e417a8c3df9dc9dfb90.jpg',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Kebabit',
                'thumbnail' => 'uploads/08db41df5c6a96311e3ad8d408ab82d6.jpg',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Kanakebabit',
                'thumbnail' => 'uploads/773aecb6e814c4341d16b632ff0f2ae0.jpg',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Vöner Not K',
                'thumbnail' => NULL,
            ),
        ));
        
        
    }
}
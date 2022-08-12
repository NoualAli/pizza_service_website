<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ingredients')->delete();
        
        \DB::table('ingredients')->insert(array (
            0 => 
            array (
                'id' => 21,
                'name' => 'jauheliha',
                'extra_price' => NULL,
            ),
            1 => 
            array (
                'id' => 22,
                'name' => 'Tonnikala',
                'extra_price' => NULL,
            ),
            2 => 
            array (
                'id' => 23,
                'name' => 'Katkarapu',
                'extra_price' => NULL,
            ),
            3 => 
            array (
                'id' => 24,
                'name' => 'Simpukka',
                'extra_price' => NULL,
            ),
            4 => 
            array (
                'id' => 25,
                'name' => 'Kebab lihaa',
                'extra_price' => NULL,
            ),
            5 => 
            array (
                'id' => 26,
                'name' => 'Ranskalaiset',
                'extra_price' => NULL,
            ),
            6 => 
            array (
                'id' => 27,
                'name' => 'dippi',
                'extra_price' => NULL,
            ),
            7 => 
            array (
                'id' => 28,
                'name' => 'Sipuli',
                'extra_price' => NULL,
            ),
            8 => 
            array (
                'id' => 29,
                'name' => 'Paprika',
                'extra_price' => NULL,
            ),
            9 => 
            array (
                'id' => 30,
                'name' => 'Persilja',
                'extra_price' => NULL,
            ),
            10 => 
            array (
                'id' => 31,
                'name' => 'Suola',
                'extra_price' => NULL,
            ),
            11 => 
            array (
                'id' => 32,
                'name' => 'Voner',
                'extra_price' => NULL,
            ),
            12 => 
            array (
                'id' => 33,
                'name' => 'Puasipuli chili',
                'extra_price' => NULL,
            ),
            13 => 
            array (
                'id' => 34,
                'name' => 'Tuore Tomaatti',
                'extra_price' => NULL,
            ),
            14 => 
            array (
                'id' => 35,
                'name' => 'Vegaanijuusto',
                'extra_price' => NULL,
            ),
            15 => 
            array (
                'id' => 36,
                'name' => 'Tuore herkkusieni',
                'extra_price' => NULL,
            ),
            16 => 
            array (
                'id' => 37,
                'name' => 'Tuore paprika',
                'extra_price' => NULL,
            ),
            17 => 
            array (
                'id' => 38,
                'name' => 'Punasipuli',
                'extra_price' => NULL,
            ),
            18 => 
            array (
                'id' => 39,
                'name' => 'Tomatti',
                'extra_price' => NULL,
            ),
            19 => 
            array (
                'id' => 40,
                'name' => 'Kebab',
                'extra_price' => NULL,
            ),
            20 => 
            array (
                'id' => 41,
                'name' => 'Pitaleipa',
                'extra_price' => NULL,
            ),
            21 => 
            array (
                'id' => 42,
                'name' => 'Salaatti',
                'extra_price' => NULL,
            ),
            22 => 
            array (
                'id' => 43,
                'name' => 'Paloiteltu leipa',
                'extra_price' => NULL,
            ),
            23 => 
            array (
                'id' => 44,
                'name' => 'Jogurtti',
                'extra_price' => NULL,
            ),
            24 => 
            array (
                'id' => 45,
                'name' => 'Ranskanperunat',
                'extra_price' => NULL,
            ),
            25 => 
            array (
                'id' => 46,
                'name' => 'Tomaattikastike',
                'extra_price' => NULL,
            ),
            26 => 
            array (
                'id' => 47,
                'name' => 'Kanan Rintafilee',
                'extra_price' => NULL,
            ),
            27 => 
            array (
                'id' => 48,
                'name' => 'Currykastike',
                'extra_price' => NULL,
            ),
            28 => 
            array (
                'id' => 49,
                'name' => 'Talon Salaatti',
                'extra_price' => NULL,
            ),
            29 => 
            array (
                'id' => 50,
                'name' => 'Valiste Lisuke',
                'extra_price' => NULL,
            ),
            30 => 
            array (
                'id' => 51,
                'name' => 'Kanakuutioita',
                'extra_price' => NULL,
            ),
            31 => 
            array (
                'id' => 52,
                'name' => 'Mexicana-Kastike',
                'extra_price' => NULL,
            ),
            32 => 
            array (
                'id' => 53,
                'name' => 'Grillautut Kasvikset',
                'extra_price' => NULL,
            ),
            33 => 
            array (
                'id' => 54,
                'name' => 'Naudanpihivi',
                'extra_price' => NULL,
            ),
            34 => 
            array (
                'id' => 55,
                'name' => 'Cheddar juusto',
                'extra_price' => NULL,
            ),
            35 => 
            array (
                'id' => 56,
                'name' => 'Maustekukku',
                'extra_price' => NULL,
            ),
            36 => 
            array (
                'id' => 57,
                'name' => 'Ketsuppi',
                'extra_price' => NULL,
            ),
            37 => 
            array (
                'id' => 58,
                'name' => 'Majoneesi',
                'extra_price' => NULL,
            ),
            38 => 
            array (
                'id' => 59,
                'name' => 'Sinappi',
                'extra_price' => NULL,
            ),
        ));
        
        
    }
}
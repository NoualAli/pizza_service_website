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
                'id' => 55,
                'name' => 'Cheddar juusto',
            ),
            1 => 
            array (
                'id' => 48,
                'name' => 'Currykastike',
            ),
            2 => 
            array (
                'id' => 27,
                'name' => 'dippi',
            ),
            3 => 
            array (
                'id' => 53,
                'name' => 'Grillautut Kasvikset',
            ),
            4 => 
            array (
                'id' => 21,
                'name' => 'jauheliha',
            ),
            5 => 
            array (
                'id' => 44,
                'name' => 'Jogurtti',
            ),
            6 => 
            array (
                'id' => 51,
                'name' => 'Kanakuutioita',
            ),
            7 => 
            array (
                'id' => 47,
                'name' => 'Kanan Rintafilee',
            ),
            8 => 
            array (
                'id' => 23,
                'name' => 'Katkarapu',
            ),
            9 => 
            array (
                'id' => 40,
                'name' => 'Kebab',
            ),
            10 => 
            array (
                'id' => 25,
                'name' => 'Kebab lihaa',
            ),
            11 => 
            array (
                'id' => 57,
                'name' => 'Ketsuppi',
            ),
            12 => 
            array (
                'id' => 58,
                'name' => 'Majoneesi',
            ),
            13 => 
            array (
                'id' => 56,
                'name' => 'Maustekukku',
            ),
            14 => 
            array (
                'id' => 52,
                'name' => 'Mexicana-Kastike',
            ),
            15 => 
            array (
                'id' => 54,
                'name' => 'Naudanpihivi',
            ),
            16 => 
            array (
                'id' => 43,
                'name' => 'Paloiteltu leipa',
            ),
            17 => 
            array (
                'id' => 29,
                'name' => 'Paprika',
            ),
            18 => 
            array (
                'id' => 30,
                'name' => 'Persilja',
            ),
            19 => 
            array (
                'id' => 41,
                'name' => 'Pitaleipa',
            ),
            20 => 
            array (
                'id' => 33,
                'name' => 'Puasipuli chili',
            ),
            21 => 
            array (
                'id' => 38,
                'name' => 'Punasipuli',
            ),
            22 => 
            array (
                'id' => 26,
                'name' => 'Ranskalaiset',
            ),
            23 => 
            array (
                'id' => 45,
                'name' => 'Ranskanperunat',
            ),
            24 => 
            array (
                'id' => 42,
                'name' => 'Salaatti',
            ),
            25 => 
            array (
                'id' => 24,
                'name' => 'Simpukka',
            ),
            26 => 
            array (
                'id' => 59,
                'name' => 'Sinappi',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Sipuli',
            ),
            28 => 
            array (
                'id' => 31,
                'name' => 'Suola',
            ),
            29 => 
            array (
                'id' => 49,
                'name' => 'Talon Salaatti',
            ),
            30 => 
            array (
                'id' => 46,
                'name' => 'Tomaattikastike',
            ),
            31 => 
            array (
                'id' => 39,
                'name' => 'Tomatti',
            ),
            32 => 
            array (
                'id' => 22,
                'name' => 'Tonnikala',
            ),
            33 => 
            array (
                'id' => 36,
                'name' => 'Tuore herkkusieni',
            ),
            34 => 
            array (
                'id' => 37,
                'name' => 'Tuore paprika',
            ),
            35 => 
            array (
                'id' => 34,
                'name' => 'Tuore Tomaatti',
            ),
            36 => 
            array (
                'id' => 50,
                'name' => 'Valiste Lisuke',
            ),
            37 => 
            array (
                'id' => 35,
                'name' => 'Vegaanijuusto',
            ),
            38 => 
            array (
                'id' => 32,
                'name' => 'Voner',
            ),
        ));
        
        
    }
}
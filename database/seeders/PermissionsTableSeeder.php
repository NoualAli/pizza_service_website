<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'create',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 00:38:39',
                'updated_at' => '2022-08-06 00:38:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'read',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 00:38:49',
                'updated_at' => '2022-08-06 00:38:49',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'write',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 00:38:53',
                'updated_at' => '2022-08-06 00:38:53',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '*',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 00:38:58',
                'updated_at' => '2022-08-06 00:38:58',
            ),
        ));
        
        
    }
}
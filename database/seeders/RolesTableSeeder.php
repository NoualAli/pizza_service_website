<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'root',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 00:39:07',
                'updated_at' => '2022-08-06 00:39:07',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'restorer',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 00:39:18',
                'updated_at' => '2022-08-06 00:39:18',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'user',
                'guard_name' => 'web',
                'created_at' => '2022-08-06 00:39:35',
                'updated_at' => '2022-08-06 00:39:35',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => '2022-08-25 13:54:19',
                'updated_at' => '2022-08-25 13:54:19',
            ),
        ));
    }
}
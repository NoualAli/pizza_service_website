<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $root = User::create([
            'username' => 'root',
            'password' => Hash::make('nfc3VHYv'),
            'email' => 'noualdev@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $admin = User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@ps.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::create([
            'firstname' => 'Ali',
            'lastname' => 'Noual',
            'phone' => '05040429296',
            'username' => 'user',
            'password' => Hash::make('user'),
            'email' => 'user@ps.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $restorer = User::create([
            'username' => 'restorer',
            'password' => Hash::make('restorer'),
            'email' => 'restorer@ps.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $restorer->assignRole('restorer');
        $user->assignRole('user');
        $admin->assignRole('admin');
        $root->assignRole('root');
    }
}
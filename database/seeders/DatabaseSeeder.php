<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create default user
         */
        $root = User::create([
            'username' => 'root',
            'password' => Hash::make('root'),
            'email' => 'noualdev@gmail.com',
            'phone' => '0540429296',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user = User::create([
            'username' => 'user',
            'password' => Hash::make('user'),
            'email' => 'user@gmail.com',
            'phone' => '',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call(MenusTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(RestaurantsTableSeeder::class);
        $this->call(RestaurantsUsersTableSeeder::class);
        $this->call(RestaurantsMenusTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(RestaurantsCategoriesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);

        $user->assignRole('user');
        $root->assignRole('root');
    }
}
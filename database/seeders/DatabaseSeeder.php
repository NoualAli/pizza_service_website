<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(MenusTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);

        $this->call(RestaurantsTableSeeder::class);

        $this->call(RestaurantsUsersTableSeeder::class);
        $this->call(RestaurantsMenusTableSeeder::class);
        $this->call(RestaurantsCategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);

        $this->call(RecipesTableSeeder::class);
        $this->call(ExtrasTableSeeder::class);
        $this->call(ProductExtrasTableSeeder::class);
    }
}
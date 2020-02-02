<?php

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
        // Register the user seeder
        $this->call(UsersTableSeeder::class);

        // Register the Colors seeder
        $this->call(ColorsTableSeeder::class);
        
        // Register the Products seeder
        $this->call(ProductsTableSeeder::class);
    }
}

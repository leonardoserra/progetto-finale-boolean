<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //da runnare solo 1 volta
        $this->call(UsersTableSeeder::class);
        $this->call(RestaurantsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(DishesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(RestaurantTypeTableSeeder::class);
        $this->call(DishOrderTableSeeder::class);
    }
}

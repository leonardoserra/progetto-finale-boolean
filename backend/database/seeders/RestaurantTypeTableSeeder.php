<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Type;

class RestaurantTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<7;$i++){
            $randomRestaurant=$i;
            $randomType=rand(1,8);
            $restaurant = Restaurant::find($randomRestaurant);
            $type = Type::find($randomType);

            $restaurant->types()->attach($type->id);
        }

        //$restaurant->types()->detach();
    }
}

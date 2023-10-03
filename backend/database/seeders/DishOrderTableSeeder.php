<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Order;

class DishOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=0;$i<50;$i++){
            $randomDish=rand(1,25);
            $randomOrder=rand(1,10);
            $order=Order::find($randomOrder);
            $dish=Dish::find($randomDish);
            $randomQuantity=rand(1,5);

            $order->dishes()->attach($dish->id, ['quantity' => $randomQuantity]);

        }
    }
}

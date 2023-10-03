<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes=['pizza','pasta','mandolino','pesce','spaghetti','braciole di maiale','acqua','coca cola'];

        for($i=1;$i<7;$i++){
            foreach($dishes as $dish){
                $newDish=new Dish();
                $newDish->name= $dish;
                $newDish->ingredients_description= 'prodotto a base di ' . $dish;
                $newDish->price= rand(2,50).'.99';
                $newDish->visibility= 1;
                $newDish->restaurant_id=$i;
                $newDish->save();
            }

        }
    }
}

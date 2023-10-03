<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = ['Pizzeria','Ristorante Cinese','Pescheria','Trattoria da kebabbaro','Kebabbaro da abdul','kebabbaro da trattoriaa'];

        foreach($restaurants as $index=>$restaurant){
            $newRestaurant=new Restaurant();
            $newRestaurant->name= $restaurant;
            $newRestaurant->user_id=$index+1;
            $newRestaurant->slug= Str::slug($restaurant,'-');
            $newRestaurant->address= 'via del non te lo dico';
            $newRestaurant->vat= '01234567891';
            //da aggiugere le immagini durante il lavoro in Front
            $newRestaurant->save();
        }
    }
}

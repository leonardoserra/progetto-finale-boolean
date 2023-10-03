<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for($i=0;$i<10;$i++){
            $newOrder =new Order();
            $newOrder->name_customer= $faker->name();
            $newOrder->address_customer= $faker->address();
            $newOrder->phone_number_customer= $faker->e164PhoneNumber();
            $newOrder->email_customer= $faker->email();
            $newOrder->total_price= $faker->randomFloat(2,10,999);
            $newOrder->status=1;
            $newOrder->save();
        }
    }
}

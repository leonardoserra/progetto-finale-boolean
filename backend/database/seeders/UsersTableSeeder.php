<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = ['Pizzeria', 'Ristorante Cinese', 'Pescheria', 'Trattoria da kebabbaro', 'Kebabbaro da abdul', 'kebabbaro da trattoriaa'];

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->email = Str::slug($user, '.') . '@gmail.com';
            $newUser->password = '$2y$10$ttxNAyar7yyIjBXVhTvkWezN/h/KVzP4frXytFkuPkGF0zemHwcIm'; //password hashata
            $newUser->save();
        }
    }
}

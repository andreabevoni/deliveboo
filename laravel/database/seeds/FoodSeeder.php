<?php

use Illuminate\Database\Seeder;
use App\Food;
use App\User;


class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Food::class, 10)->make()->each(function ($food) {
            $user = User::inRandomOrder()->first();
            $food->user()->associate($user);
            $food->save();
        });
    }
}

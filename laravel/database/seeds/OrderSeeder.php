<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Food;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function ($order) {
            $food = Food::inRandomOrder()->limit(rand(1, 5))->get();
            $order->food()->attach($food);
        });
    }
}

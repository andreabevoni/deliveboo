<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Food;
use App\User;



class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 500)->create()->each(function ($order) {
            $user = User::inRandomOrder()->first();
            $foods = Food::where('user_id', $user -> id)->inRandomOrder()->limit(rand(1, 5))->get();

            // assegno una quantitá da 1 a 5 ad ogni cibo ordinato
            $sync_data = [];
            foreach ($foods as $food) {
              $sync_data[$food -> id] = ['quantity' =>rand(1, 5)];
            }
            $order->food()->sync($sync_data);

            // calcolo il totale reale del cibo ordinato nell'ordine
            foreach ($order -> food as $food) {
              $order -> total += $food -> price * $food -> pivot -> quantity;
            }
            $order->save();
        });
    }
}

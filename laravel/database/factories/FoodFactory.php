<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Food;
use Faker\Generator as Faker;

$factory->define(Food::class, function (Faker $faker) {

    $faker = \Faker\Factory::create();
    $faker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));

    return [
        'name' => $faker->foodName(),
        'price' => rand(100, 1500),
        'description' => $faker->paragraph(3),
        // 'category' => $faker->unique()->randomElement([
        //           'Antipasti',
        //           'Primi piatti',
        //           'Secondi piatti',
        //           'Contorni',
        //           'Pizze',
        //           'Dessert']),
        'visible' => rand(0, 1)
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Food;
use Faker\Generator as Faker;

// $faker = \Faker\Factory::create();
// $faker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));

$factory->define(Food::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => rand(100, 5000),
        'description' => $faker->paragraph(3),
        'category' => $faker->word,
        'visible' => rand(0, 1)
    ];
});

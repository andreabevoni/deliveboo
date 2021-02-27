<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastname' => $faker->lastname,
        'date' => $faker->date,
        'total' => rand(100, 9000),
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'address' => $faker->address
    ];
});

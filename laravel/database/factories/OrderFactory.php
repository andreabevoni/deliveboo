<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    $dt = $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now');
    $date = $dt->format("Y-m-d");

    return [
        'name' => $faker->name,
        'lastname' => $faker->name,
        'date' => $date,
        'total' => 0,
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'address' => $faker->address
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'restaurant_name' => $faker->unique()->randomElement([
                  'Pizzeria Belvedere',
                  'Ristorante Da Carletto',
                  'Il Ritrovo del Boss',
                  'Sakura',
                  'Osteria del Passatore',
                  'America Graffiti',
                  'La Pignata De Geval',
                  'Ristorante Al Deserto',
                  'La Griglia',
                  'Radicchio Rosso',
                  'Osteria La Cadrega',
                  'Il Mandarino',
                  'Laboratorio del Palato',
                  'Ca de Ven',
                  'Casa delle Aie',
                  'Ristorante Al Moro',
                  'Trattoria Al Cerchio',
                  'Ali Kebab',
                ]),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'p_iva' => $faker->swiftBicNumber,
        'closing_day' => rand(0, 7),
        'opening_time' => $faker->time,
        'closing_time' => $faker->time,

        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Typology;
use Faker\Generator as Faker;

$factory->define(Typology::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement([
                  'Italiano',
                  'Americano',
                  'Cinese',
                  'Giapponese',
                  'Messicano',
                  'Francese',
                  'Spagnolo',
                  'Indiano',
                  'Thailandese',
                  'Turco'])
    ];
});

<?php

use Illuminate\Database\Seeder;
use App\Typology;
use App\User;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Typology::class, 10)->create()->each(function ($typology) {
            $user = User::inRandomOrder()->limit(rand(1, 5))->get();
            $typology->users()->attach($user);
        });
    }
}

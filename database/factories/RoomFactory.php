<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\room;
use Faker\Generator as Faker;

$factory->define(room::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->regexify('[A-Z][0-9]{4}'),
        'libel' => 'Salle '.$faker->numberBetween(1,20),
        'capacity' => $faker->numberBetween(25,35),
    ];
});

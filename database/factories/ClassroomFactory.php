<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\classroom;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(classroom::class, function (Faker $faker) {
    return [
        'room_id' => $faker->numberBetween(1,10),
        'code' => $faker->unique()->regexify('[A-Z][0-9]{3}'),
        'libel' => Arr::random([
            "SIGL1",
            "RTEL1",
            "SRIT1",
            "TWIN1",
            "SIGL2",
            "RTEL2",
            "SRIT2",
            "TWIN2",
            "SIGL3", 
            "RTEL3",
            "SRIT3",
            "TWIN3",
            "SIGL3",
        ]),
    ];
});

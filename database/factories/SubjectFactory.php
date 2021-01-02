<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\subject;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(subject::class, function (Faker $faker) {
    return [
        // 'code' => $faker->regexify('[A-Z0-9]+[A-Z0-9]+\[A-Z]{2}'),
        // 'libel' => Arr::random([
        //     'Algèbre'
        // ]),
    ];
});

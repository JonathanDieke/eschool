<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\category;
use Faker\Generator as Faker;

$factory->define(category::class, function (Faker $faker) {
    return [
        // 'code' => $faker->unique()->regexify('[A-Z][0-9]{2}'),
        // 'libel' => 'Mathematics',
    ];
});

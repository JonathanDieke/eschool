<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\student;
use Faker\Generator as Faker;

$factory->define(student::class, function (Faker $faker) {
    return [
        "register" => \Carbon\Carbon::now()->format('y')."ESATIC". $faker->unique()->regexify('[A-Z][0-9]{2}'),
        "classroom_id" => $faker->numberBetween(1,10),
        "fullname" => $faker->name,
        "birthday" => $faker->date($format = 'Y-m-d', $max = '-5 years'),
        "birthplace" => $faker->city,
        "avatar" => "avatars/avatar.jpg",
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\teacher;
use Faker\Generator as Faker;

$factory->define(teacher::class, function (Faker $faker) {
    return [
        "subject_id" => $faker->numberBetween(1,8),
        "register" => $faker->shuffle('PROFTIC12345'),
        "fullname" => $faker->name,
        "email" => $faker->email,
        "birthday" => $faker->date($format = 'Y-m-d', $max = '-15 years'),
        "birthplace" => $faker->city,
        "avatar" => "avatars/avatar.jpg",
    ];
});

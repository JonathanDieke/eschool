<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\rating;
use Faker\Generator as Faker;

$factory->define(rating::class, function (Faker $faker) {
    return [
        "student_id" => $faker->numberBetween(1,23),
        "subject_code" => $faker->numberBetween(1,23),
        "teacher_id" => $faker->numberBetween(1,23),
        "qz1" => $faker->numberBetween(1,20),
        "qz2" => $faker->numberBetween(1,20),
        "qz3" => $faker->numberBetween(1,20),
        "assignment" => $faker->numberBetween(1,20),
        "examen" => $faker->numberBetween(1,20),
    ];
});

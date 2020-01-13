<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'release_date' => $faker->date(),
    ];
});

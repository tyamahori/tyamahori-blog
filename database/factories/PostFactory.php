<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'title'       => $faker->text($maxNbChars = 20),
        'description' => $faker->text($maxNbChars = 50),
        'post'        => $faker->text($maxNbChars = 1000),
        'published'   => $faker->boolean(0),
        'category_id' => $faker->numberBetween($min = 1, $max = 10)
    ];
}, 'privateMockPostData');

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'title'       => $faker->text($maxNbChars = 20),
        'description' => $faker->text($maxNbChars = 50),
        'post'        => $faker->text($maxNbChars = 1000),
        'published'   => $faker->boolean(100),
        'category_id' => $faker->numberBetween($min = 1, $max = 10)
    ];
}, 'publicMockPostData');

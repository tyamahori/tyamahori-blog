<?php

use Faker\Generator as Faker;
use App\Eloquent\PostOrm;
use Carbon\Carbon;

$factory->define(PostOrm::class, static function (Faker $faker) {
    $time = Carbon::now()->subMinutes($faker->unique()->numberBetween(1, 230));
    return [
        'title'       => $faker->text($maxNbChars = 20),
        'description' => $faker->text($maxNbChars = 50),
        'post'        => $faker->text($maxNbChars = 1000),
        'published'   => $faker->boolean(0),
        'category_id' => $faker->numberBetween($min = 1, $max = 10),
        'created_at'  => $time,
        'updated_at'  => $time,
    ];
}, 'privateMockPostData');

$factory->define(PostOrm::class, static function (Faker $faker) {
    $time = Carbon::now()->subMinutes($faker->unique()->numberBetween(1, 230));
    return [
        'title'       => $faker->text($maxNbChars = 20),
        'description' => $faker->text($maxNbChars = 50),
        'post'        => $faker->text($maxNbChars = 1000),
        'published'   => $faker->boolean(100),
        'category_id' => $faker->numberBetween($min = 1, $max = 10),
        'created_at'  => $time,
        'updated_at'  => $time,
    ];
}, 'publicMockPostData');

<?php

use Faker\Generator as Faker;
use App\Eloquent\CategoryOrm;

$factory->define(CategoryOrm::class, static function (Faker $faker) {
    return [
        'category' => $faker->text($maxNbChars = 10),
    ];
});

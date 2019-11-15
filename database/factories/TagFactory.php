<?php

use Faker\Generator as Faker;
use App\Eloquent\TagOrm;

$factory->define(TagOrm::class, static function (Faker $faker) {
    return [
        TagOrm::getNameColumn() => $faker->text($maxNbChars = 10),
    ];
});

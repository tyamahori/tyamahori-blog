<?php

use Faker\Generator as Faker;
use App\Models\Tag;

$factory->define(Tag::class, static function (Faker $faker) {
    return [
        Tag::getNameColumn() => $faker->text($maxNbChars = 10),
    ];
});

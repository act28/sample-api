<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Models\Library\Library::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->randomNumber(5, true),
        'code' => strtoupper(str_repeat($faker->randomLetter, 3)) . $faker->randomNumber(3, true),
        'name' => $faker->words(3, true),
        'abbr' => strtoupper(str_repeat($faker->randomLetter, 3)),
        'url' => $faker->url,
    ];
});
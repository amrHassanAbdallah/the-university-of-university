<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->title . ' ' . $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'level' => 'teacher',
    ];
});


$factory->define(App\Course::class, function (Faker $faker) {
    return [
        /*        'name' => $faker->title,*/
        'name' => $faker->text(20),
        'code' => str_random(5),
        'description' => $faker->text,
        'total_grade' => 100,
    ];
});


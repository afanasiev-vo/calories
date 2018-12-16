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
        'name' => 'SYSTEM',
        'email' => 'system@calories.com',
        'email_verified_at' => now(),
        'password' => app('hash')->make('12345'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => 'ADMIN',
        'email' => 'admin@calories.com',
        'email_verified_at' => now(),
        'password' => app('hash')->make('12345'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => app('hash')->make('12345'),
        'remember_token' => str_random(10),
    ];
});

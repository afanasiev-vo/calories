<?php
/**
 * Created by PhpStorm.
 * User: afanasievv
 * Date: 17.12.18
 * Time: 21:59
 */

use Faker\Generator as Faker;

$factory->define(App\Ingredient::class, function (Faker $faker) {
    return [
        'name' => $faker->word(1),
        'thumbnail' => $faker->imageUrl(),
        'description' => $faker->text(),
        'state' => 'raw',
        'status' => \App\Ingredient::ACTIVE
    ];
});

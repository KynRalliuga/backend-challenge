<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Product::class, function (Faker $faker) {
    return [
        'titulo' => $faker->name,
        'descricao' => $faker->text,
        'cores_array' => '[' . $faker->numberBetween(1,10) . ',' . $faker->numberBetween(1,10) . ',' . $faker->numberBetween(1,10) . ',' . $faker->numberBetween(1,10) . ']',
        'color_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,10),
    ];
});

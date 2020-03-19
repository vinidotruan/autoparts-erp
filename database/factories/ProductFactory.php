<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => Category::all()->random()->id,
        'title' => Str::random(10),
        'ref' => $faker->randomNumber,
        'application' => $faker->text,
        'value_cost' => $faker->randomFloat(),
        'value_sell' => $faker->randomFloat(),
        'amount' => $faker->randomNumber,
    ];
});

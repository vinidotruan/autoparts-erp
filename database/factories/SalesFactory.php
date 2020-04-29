<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sales;
use App\User;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Sales::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'product_id' => Product::all()->random()->id,
        'amount' => $faker->numberBetween(1, 100),
    ];
});

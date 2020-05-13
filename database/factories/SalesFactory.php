<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sales;
use App\User;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Sales::class, function (Faker $faker) {
    $amount = $faker->numberBetween(1, 100);
    $product = Product::all()->random();
    return [
        'user_id' => User::all()->random()->id,
        'product_id' => $product->id,
        'amount' => $amount,
        'price' => $amount * $product->value_sell,
    ];
});

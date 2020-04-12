<?php

/** @var Factory $factory */

use App\Http\Models\Order;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
    ];
});

<?php

/** @var Factory $factory */

use App\Http\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'balance' => $faker->randomFloat(2, 0, 999),
    ];
});

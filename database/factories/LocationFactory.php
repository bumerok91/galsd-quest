<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
    ];
});

<?php

/** @var Factory $factory */

use App\Http\Models\Location;
use App\Http\Models\Shipment;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Shipment::class, function (Faker $faker) use ($factory) {
    $receivedLocation = $factory->create(Location::class);
    $issuedLocation = $factory->create(Location::class);
    return [
        'received_location_id' => $receivedLocation->id,
        'issued_location_id' => $issuedLocation->id,
        'status' => Shipment::STATUS_CREATED,
        'amount' => $faker->randomFloat(2, 0, 99),
    ];
});
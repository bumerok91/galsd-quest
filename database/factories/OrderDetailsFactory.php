<?php

/** @var Factory $factory */

use App\Http\Models\{Order, OrderDetails, Shipment};
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(OrderDetails::class, function (Faker $faker) use ($factory) {
    $orderId = $faker->uuid;
    /** @var Order $order */
    $factory->create(Order::class, ['id' => $orderId]);
    /** @var Shipment $shipment */
    $shipment = $factory->create(Shipment::class);
    return [
        'order_id' => $orderId,
        'shipment_id' => $shipment->id,
        'from_id' => $shipment->received_location_id,
        'to_id' => $shipment->issued_location_id
    ];
});

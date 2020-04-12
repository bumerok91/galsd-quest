<?php

use App\Http\Models\Shipment;
use App\Http\Models\Task;
use App\Http\Models\User;

class CompleteTaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTaskComplete()
    {
        /** @var User $user */
        //Get any user
        $user = User::query()->limit(1)->first();

        //Get Any new shipment
        /** @var Shipment $shipment */
        $shipment = Shipment::query()->where([
            'status' => Shipment::STATUS_CREATED
        ])->limit(1)
            ->first();

        $this->post('/task/complete', [
            'user_id' => $user->id,
            'shipment_id' => $shipment->id,
            'type' => Task::TYPE_RECEIPT
        ])->seeJson([
            'Task has been sent to process!'
        ]);

        $this->seeInDatabase('task', [
            'user_id' => $user->id,
            'shipment_id' => $shipment->id,
            'type' => Task::TYPE_RECEIPT,
            'completed' => true
        ]);

        $this->seeInDatabase('shipment', [
            'id' => $shipment->id,
            'status' => Shipment::STATUS_RECEIVED,
        ]);

        $this->post('/task/complete', [
            'user_id' => $user->id,
            'shipment_id' => $shipment->id,
            'type' => Task::TYPE_DELIVERY
        ])->seeJson([
            'Task has been sent to process!'
        ]);

        $this->seeInDatabase('task', [
            'user_id' => $user->id,
            'shipment_id' => $shipment->id,
            'type' => Task::TYPE_DELIVERY,
            'completed' => true
        ]);

        $this->seeInDatabase('shipment', [
            'id' => $shipment->id,
            'status' => Shipment::STATUS_DELIVERED,
        ]);
    }
}

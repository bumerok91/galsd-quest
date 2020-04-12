<?php

namespace App\Http\Controllers;

use App\Events\CompleteTaskEvent;
use App\Http\Models\{Shipment, Task};
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|int|exists:user,id',
            'shipment_id' => 'required|int|exists:shipment,id',
            'type' => 'required|string|in:' . implode(',', Task::AVAILABLE_TYPES),
        ]);

        /** @var Shipment $shipment */
        $shipment = Shipment::query()->findOrFail($request->shipment_id);

        if ($shipment->status === Shipment::STATUS_DELIVERED) {
            return new JsonResponse('This shipment already delivered.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var Task $task */
        $task = Task::query()->firstOrCreate([
            'user_id' => $request->user_id,
            'shipment_id' => $request->shipment_id,
            'type' => $request->type,
        ], [
            'completed' => false,
            'location_id' => $shipment->getLocationByTaskType($request->type)
        ]);

        if ($task->completed) {
            return new JsonResponse('Task already completed.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($task->type === Task::TYPE_DELIVERY) {
            $wasReceivedByCurrentUser = Task::query()->where([
                'user_id' => $task->user_id,
                'completed' => true,
                'shipment_id' => $shipment->id,
                'type' => Task::TYPE_RECEIPT
            ])->exists();

            if (!$wasReceivedByCurrentUser) {
                return new JsonResponse('This shipment must be already received by current user.', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        $event = new CompleteTaskEvent($task);
        event($event);

        return new JsonResponse('Task has been sent to process!');
    }
}
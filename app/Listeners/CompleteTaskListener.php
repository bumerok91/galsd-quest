<?php


namespace App\Listeners;


use App\Events\CompleteTaskEvent;
use App\Http\Models\Shipment;
use App\Http\Models\Task;
use Illuminate\Support\Facades\DB;

class CompleteTaskListener extends BaseListener
{
    /**
     * @param CompleteTaskEvent $event
     */
    public function handle(CompleteTaskEvent $event)
    {
        Db::beginTransaction();
        switch ($event->task->type) {
            case Task::TYPE_RECEIPT:
                $event->task->shipment->status = Shipment::STATUS_RECEIVED;

                break;
            case Task::TYPE_DELIVERY:
                $event->task->shipment->status = Shipment::STATUS_DELIVERED;
                $event->task->user->balance = round($event->task->user->balance + $event->task->shipment->amount, 2);
        }
        $event->task->completed = true;

        try {
            $event->task->saveOrFail();
            $event->task->shipment->saveOrFail();
            if ($event->task->user->wasChanged()) {
                $event->task->user->saveOrFail();
            }
        } catch (\Throwable $e) {
            DB::rollBack();

            $this->logger->error('Task Complete error' . PHP_EOL . $e->getMessage(), $e->getTrace());
        }

        DB::commit();
    }
}
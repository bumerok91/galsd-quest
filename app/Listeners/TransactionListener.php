<?php

namespace App\Listeners;

use App\Events\TransactionEvent;
use App\Http\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionListener extends BaseListener
{
    /**
     * @param TransactionEvent $event
     */
    public function handle(TransactionEvent $event)
    {
        DB::beginTransaction();
        //deducted money from the sender
        $event->from->balance = round($event->from->balance - $event->amount, 2);

        //credited to the recipient
        $event->to->balance = round($event->to->balance + $event->amount, 2);

        $fromTransaction = new Transaction();
        $fromTransaction->setFromId($event->from->id)
            ->setToId($event->to->id)
            ->setAmount(round(0 - $event->amount, 2))
            ->setBalance($event->from->balance)
            ->setAction(Transaction::ACTION_SENT);

        $toTransaction = new Transaction();
        $toTransaction->setFromId($event->from->id)
            ->setToId($event->to->id)
            ->setAmount($event->amount)
            ->setBalance($event->to->balance)
            ->setAction(Transaction::ACTION_RECEIVED);

        try {
            $event->from->saveOrFail();
            $event->to->saveOrFail();
            $fromTransaction->saveOrFail();
            $toTransaction->saveOrFail();
        } catch (\Throwable $e) {
            DB::rollBack();

            $this->logger->error('Transaction error!' . PHP_EOL . $e->getMessage(), $e->getTrace());
        }

        DB::commit();
    }
}

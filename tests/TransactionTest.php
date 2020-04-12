<?php

use App\Http\Models\Transaction;
use App\Http\Models\User;

class TransactionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTransaction()
    {
        //Get any 2 users with positive balance
        $users = User::query()->where('balance', '>', 1)
            ->limit(2)
            ->get();

        $amount = 0.99;

        /** @var User $from */
        $from = $users[0];
        $senderProbablyBalance = round($from->balance - $amount, 2);

        /** @var User $to */
        $to = $users[1];
        $recipientProbablyBalance = round($to->balance + $amount, 2);

        $this->post('/user/transaction', [
            'from' => $from->id,
            'to' => $to->id,
            'amount' => $amount
        ])->seeJson([
            'Transaction has been sent for processing!'
        ]);

        /** @var User $sender */
        $sender = User::query()->findOrFail($from->id);
        /** @var User $recipient */
        $recipient = User::query()->findOrFail($to->id);

        $this->assertEquals($senderProbablyBalance, $sender->balance);
        $this->assertEquals($recipientProbablyBalance, $recipient->balance);

        $this->seeInDatabase('transaction', [
            'from_id' => $from->id,
            'to_id' => $to->id,
            'action' => Transaction::ACTION_SENT
        ]);
        $this->seeInDatabase('transaction', [
            'from_id' => $from->id,
            'to_id' => $to->id,
            'action' => Transaction::ACTION_RECEIVED
        ]);
    }
}

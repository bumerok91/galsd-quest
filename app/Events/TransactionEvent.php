<?php

namespace App\Events;

use App\Http\Models\User;

class TransactionEvent extends Event
{
    /**
     * @var User
     */
    public $from;
    /**
     * @var User
     */
    public $to;
    /**
     * @var float
     */
    public $amount;

    /**
     * Create a new event instance.
     *
     * @param User $from
     * @param User $to
     * @param float $amount
     */
    public function __construct(User $from, User $to, float $amount)
    {
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
    }
}

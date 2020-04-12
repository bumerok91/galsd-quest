<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Http\Models
 *
 * @property int $from_id
 * @property int $to_id
 * @property float $amount
 * @property float $balance
 * @property string $action
 */
class Transaction extends Model
{
    public const ACTION_SENT = 'sent';
    public const ACTION_RECEIVED = 'received';

    protected $table = 'transaction';
    public $timestamps = false;

    /**
     * @return int
     */
    public function getFromId(): int
    {
        return $this->from_id;
    }

    /**
     * @param int $from_id
     * @return Transaction
     */
    public function setFromId(int $from_id): Transaction
    {
        $this->from_id = $from_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getToId(): int
    {
        return $this->to_id;
    }

    /**
     * @param int $to_id
     * @return Transaction
     */
    public function setToId(int $to_id): Transaction
    {
        $this->to_id = $to_id;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Transaction
     */
    public function setAmount(float $amount): Transaction
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     * @return Transaction
     */
    public function setBalance(float $balance): Transaction
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     * @return Transaction
     */
    public function setAction(string $action): Transaction
    {
        $this->action = $action;
        return $this;
    }
}
<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 * @package App\Http\Models
 *
 * @property string $id
 */
class Order extends Model
{
    protected $table = 'order';
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(OrderDetails::class, 'id', 'order_id');
    }
}
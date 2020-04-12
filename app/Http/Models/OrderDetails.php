<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Order
 * @package App\Http\Models
 *
 * @property int $id
 * @property string $order_id
 * @property int $shipment_id
 * @property int $form_id
 * @property int $to_id
 *
 * @property Shipment $shipment
 * @property Order $order
 */
class OrderDetails extends Model
{
    protected $table = 'order_details';
    public $timestamps = false;

    /**
     * @return HasOne
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'order_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function shipment(): HasOne
    {
        return $this->hasOne(Shipment::class, 'shipment_id', 'id');
    }
}
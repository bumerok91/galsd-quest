<?php

namespace App\Http\Models;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Validator\ValidatorInterface;

/**
 * Class Task
 * @package App\Http\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $location_id
 * @property int $shipment_id
 * @property bool $completed
 * @property string $type
 *
 * @property User $user
 * @property Location $location
 * @property Shipment $shipment
 */
class Task extends Model
{
    public const TYPE_DELIVERY = 'delivery';
    public const TYPE_RECEIPT = 'receipt';

    public const AVAILABLE_TYPES = [
        self::TYPE_DELIVERY,
        self::TYPE_RECEIPT
    ];

    public $timestamps = false;
    protected $table = 'task';
    protected $fillable = [
        'user_id',
        'shipment_id',
        'type',
        'completed',
        'location_id',
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function location(): HasOne
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    /**
     * @return HasOne
     */
    public function shipment(): HasOne
    {
        return $this->hasOne(Shipment::class, 'id', 'shipment_id');
    }
}
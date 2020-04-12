<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Shipment
 * @package App\Http\Models
 *
 * @property int $id
 * @property int $received_location_id
 * @property int $issued_location_id
 * @property string $status
 * @property float $amount
 */
class Shipment extends Model
{
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_RECEIVED = 'received';
    public const STATUS_CREATED = 'created';

    private const MAP_TASK_TYPE_TO_LOCATION = [
        Task::TYPE_RECEIPT => 'received_location_id',
        Task::TYPE_DELIVERY => 'issued_location_id'
    ];

    protected $table = 'shipment';
    public $timestamps = false;

    /**
     * @param string $taskType
     * @return int|null
     */
    public function getLocationByTaskType(string $taskType): ?int
    {
        if (!isset(self::MAP_TASK_TYPE_TO_LOCATION[$taskType])) {
            return null;
        }
        $locationField = self::MAP_TASK_TYPE_TO_LOCATION[$taskType];

        return $this->$locationField;
    }
}
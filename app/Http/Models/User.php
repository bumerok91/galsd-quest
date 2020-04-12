<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Http\Models
 *
 * @property int $id
 * @property string $name
 * @property float $balance
 */
class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;
}
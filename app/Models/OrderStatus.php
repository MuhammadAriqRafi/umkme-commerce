<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    public const ON_PROGRESS = 1;
    public const SENT = 2;
    public const CANCELED = 3;

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordPembeli extends Model
{
    use HasFactory;

    protected $table = 'record_pembeli';
    protected $guarded = ['id'];
}

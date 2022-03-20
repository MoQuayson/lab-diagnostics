<?php

namespace App\Models;

use App\Helpers\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory, UsesUUID;

    protected $table = "appointment";
    protected $fillable  = [
        'user_id',
        'schedule',
        'status',
    ];
}

<?php

namespace App\Models;

use App\Helpers\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTests extends Model
{
    use HasFactory,UsesUUID;

    protected $table = "lab_tests";
    protected $fillable  = [
        'user_id',
        'name',
        'price',
        'results',
        'status',
    ];
}

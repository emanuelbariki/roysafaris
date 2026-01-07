<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_code',
        'name',
        'description',
        'location',
        'price',
        'duration',
        'start_date',
        'end_date',
    ];
}

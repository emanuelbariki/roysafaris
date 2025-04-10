<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'ref',
        'group_name',
        'nationality',
        'remarks',
        'file_owner',
        'agent_code',
        'booking_code',
        'arrival_date',
        'departure_date',
        'pickup_details',
        'drop_details',
        'adults',
        'children',
        'infants',
        'rooms',
        'services',
        'notes'
    ];
    protected $casts = [
        'services' => 'array',
    ];
    

}

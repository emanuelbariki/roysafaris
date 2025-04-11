<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'seating', 'transmission', 'drive', 'fuel', 'ac', 'rate',
        'status', 'image', 'insurance_doc', 'registration_doc',
        'available_from', 'available_until'
    ];
}

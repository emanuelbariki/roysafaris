<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'license_no', 'driver_type_id', 'fleet_id', 'phone', 'email', 'status'];

    /**
     * Relationship: A Driver belongs to a Fleet.
     */
    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }

    /**
     * Relationship: A Driver belongs to a DriverType.
     */
    public function driverType()
    {
        return $this->belongsTo(DriverType::class);
    }
}

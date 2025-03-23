<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $guarded = [];

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

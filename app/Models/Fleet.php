<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    //
    protected $guarded = [];


    /**
     * Relationship with FleetType.
     */
    public function fleetType()
    {
        return $this->belongsTo(FleetType::class, 'fleet_type_id');
    }

    /**
     * Relationship with FleetClass.
     */
    public function fleetClass()
    {
        return $this->belongsTo(FleetClass::class, 'fleet_class_id');
    }

    /**
     * Relationship: A Fleet has many Drivers.
     */
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
}

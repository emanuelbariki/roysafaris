<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetClass extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationship with Fleet.
     */
    public function fleets()
    {
        return $this->hasMany(Fleet::class, 'fleet_class_id');
    }
}

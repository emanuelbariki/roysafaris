<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fleets()
    {
        return $this->hasMany(Fleet::class, 'fleet_type_id');
    }
}

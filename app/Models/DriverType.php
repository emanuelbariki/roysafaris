<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverType extends Model
{
    //
    protected $guarded = [];

    /**
     * Relationship: A DriverType has many Drivers.
     */
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
}

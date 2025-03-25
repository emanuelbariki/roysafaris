<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $guarded = [];
    
    /**
     * Get the country that this city belongs to.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

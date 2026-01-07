<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationship with City.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Relationship with Country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

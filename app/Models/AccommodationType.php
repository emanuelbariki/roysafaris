<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationType extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationship with Accommodation
     * An accommodation type can have many accommodations.
     */
    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }
}

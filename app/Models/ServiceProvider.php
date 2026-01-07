<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationship with Country.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

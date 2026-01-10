<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mountain extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the routes for the mountain.
     */
    public function routes(): HasMany
    {
        return $this->hasMany(MountainRoute::class, 'mountain_id');
    }
}

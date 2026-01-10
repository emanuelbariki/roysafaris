<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MountainRoute extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the mountain that owns the route.
     */
    public function mountain(): BelongsTo
    {
        return $this->belongsTo(Mountain::class, 'mountain_id');
    }
}

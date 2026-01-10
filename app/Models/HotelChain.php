<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelChain extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the accommodations for the hotel chain.
     */
    public function accommodations(): HasMany
    {
        return $this->hasMany(Accommodation::class, 'hotel_chain_id');
    }
}

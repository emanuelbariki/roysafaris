<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Accommodation extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationship with Hotel Chain
     * Each accommodation belongs to a hotel chain (parent hotel).
     */
    public function hotelChain(): BelongsTo
    {
        return $this->belongsTo(HotelChain::class, 'hotel_chain_id');
    }

    /**
     * Relationship with Accommodation Type
     * Each accommodation belongs to a specific type (camp, hotel, lodge, etc.).
     */
    public function accommodationType(): BelongsTo
    {
        return $this->belongsTo(AccommodationType::class, 'accommodations_type_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    //
    protected $guarded = [];

    /**
     * Relationship with Hotel Chain
     * Each accommodation belongs to a hotel chain (parent hotel).
     */
    public function hotelChain()
    {
        return $this->belongsTo(HotelChain::class, 'hotel_chain_id');
    }

    /**
     * Relationship with Accommodation Type
     * Each accommodation belongs to a specific type (camp, hotel, lodge, etc.).
     */
    public function accommodationType()
    {
        return $this->belongsTo(AccommodationType::class, 'accommodations_type_id');
    }

    /**
     * Relationship with Payments (if relevant)
     * An accommodation may have multiple payments linked to it (e.g., bookings, reservations).
     */
    // public function payments()
    // {
    //     return $this->hasMany(Payment::class);  // Assuming there's a Payment model
    // }

    /**
     * Relationship with Vouchers (if relevant)
     * An accommodation might have many vouchers associated with it.
     */
    // public function vouchers()
    // {
    //     return $this->hasMany(Voucher::class);  // Assuming there's a Voucher model
    // }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class reservation extends Model
{
    use HasFactory;

        protected $fillable = [
            'guest_name',
            'agent_name',
            'booking_code',
            'arrival',
            'departure',
            'nights',
            'arrival_time',
            'lodge_code',
            'property_name',
            'adults',
            'children',
            'juniors',
            'infants',
            'room_id',
            'day_room',
            'user_id',
            'booking_date',
            'internal_ref',
            'reservation_code',
            'guest_notes',
            'internal_remarks',
            'status',
        ];


        // Define the relationship with the User model
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    
        // Define the relationship with the Room model
        public function room()
        {
            return $this->belongsTo(Room::class);
        }
    
        // Define the relationship with the Payment model
        public function payments()
        {
            return $this->hasMany(Payment::class);
        }
    
        // Define the relationship with the Voucher model
        public function voucher()
        {
            return $this->hasOne(Voucher::class);
        }
}

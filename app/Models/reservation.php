<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class reservation extends Model
{
    use HasFactory;

        protected $fillable = [
            'guest_name',
            'agent_id',
            'country_id',
            'total_rooms',
            'total_pax',
            'lodge_id',
            'arrival',
            'arrival_time',
            'property_name',
            'booking_code',
            'departure',
            'nights',
            'adults',
            'children',
            'juniors',
            'infants',
            'day_room',
            'user_id',
            'booking_date',
            'internal_ref',
            'reservation_code',
            'room_detail',
            'guest_notes',
            'internal_remarks',
            'current_version',
            'prior_version',
            'voucher_issue_date',
            'issue_date',
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

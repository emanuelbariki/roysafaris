<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = [
        'reservation_id',
        'date',
        'currency_id',
        'payment_amount',
        'payment_date',
        'payment_mode',
        'payment_details',
    ];

    public function reservation()
        {
            return $this->belongsTo(Reservation::class);
        }

            public function currency()
        {
            return $this->belongsTo(Currency::class);
        }
}
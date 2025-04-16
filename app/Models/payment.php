<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = [
        'reservation_id',
        'date',
        'currency_id',
        'amount',
        'payment_method',
        'mode',
        'details',
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
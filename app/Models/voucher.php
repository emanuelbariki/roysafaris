<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class voucher extends Model
{
    //
    protected $guarded = [];

    public function reservation()
    {
        return $this->belongsTo(reservation::class, 'ref_id', 'id');
    }
}

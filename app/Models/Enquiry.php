<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'first_name', 'last_name', 'email', 'phone', 'mobile', 'country_id', 'address', 'city', 'postal_code',
    //     'arrival_date', 'departure_date', 'flexible_dates', 'adults', 'children', 'infants', 'juniors',
    //     'special_interests', 'budget_range', 'referral_source', 'comments', 'status', 'user_id', 'draft',
    // ];
    protected $guarded = [];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkFee extends Model
{
    //
    protected $guarded = [];

    /**
     * Relationship: A park fee belongs to a national park
     */
    public function nationalPark()
    {
        return $this->belongsTo(NationalPark::class);
    }

    /**
     * Relationship: A park fee belongs to a fee type
     */
    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    /**
     * Relationship: A park fee belongs to a visitor category
     */
    public function visitorCategory()
    {
        return $this->belongsTo(VisitorCategory::class);
    }

    /**
     * Relationship: A park fee belongs to an age group
     */
    public function ageGroup()
    {
        return $this->belongsTo(AgeGroup::class);
    }

    /**
     * Relationship: A park fee belongs to a season
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    /**
     * Relationship: A park fee belongs to a currency
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}

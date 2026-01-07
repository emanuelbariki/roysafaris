<?php

namespace App\Models;

use App\Enums\ServiceItemCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the category of the service item.
     */
    public function getCategory(): ServiceItemCategory
    {
        return ServiceItemCategory::from($this->category);
    }

    /**
     * Scope a query to only include service items of a given category.
     */
    public function scopeOfCategory($query, ServiceItemCategory $category)
    {
        return $query->where('category', $category->value);
    }
}

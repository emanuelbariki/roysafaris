<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SystemModule extends Model
{
    use HasFactory;

    protected $fillable = ['slug'];

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'system_module_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['system_module_id', 'ability', 'description'];

    /**
     * Get the system module that owns the permission.
     */
    public function systemModule(): BelongsTo
    {
        return $this->belongsTo(SystemModule::class);
    }

    /**
     * The roles that belong to the permission.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

    /**
     * Scope to filter permissions by module.
     */
    public function scopeByModule($query, $moduleId)
    {
        return $query->where('system_module_id', $moduleId);
    }
}

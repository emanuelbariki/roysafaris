<?php

namespace App\Observers;

use App\Models\Role;
use App\Helpers\PermissionCacheHelper;

class RoleObserver
{
    /**
     * Handle events after role is saved (permissions might have changed)
     */
    public function updated(Role $role): void
    {
        // Check if permissions were detached or attached
        if ($role->isDirty('name') || $role->permissions()->exists()) {
            PermissionCacheHelper::clearPermissionCache();
        }
    }

    /**
     * Handle events after role is deleted
     */
    public function deleted(Role $role): void
    {
        PermissionCacheHelper::clearPermissionCache();
    }
}

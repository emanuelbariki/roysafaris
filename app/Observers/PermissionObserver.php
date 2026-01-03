<?php

namespace App\Observers;

use App\Models\Permission;
use App\Helpers\PermissionCacheHelper;

class PermissionObserver
{
    /**
     * Handle events after permission is created, updated, or deleted
     */
    public function saved(Permission $permission): void
    {
        PermissionCacheHelper::clearPermissionCache();
    }

    /**
     * Handle events after permission is deleted
     */
    public function deleted(Permission $permission): void
    {
        PermissionCacheHelper::clearPermissionCache();
    }
}

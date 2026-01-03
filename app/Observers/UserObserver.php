<?php

namespace App\Observers;

use App\Models\User;
use App\Helpers\PermissionCacheHelper;

class UserObserver
{
    /**
     * Handle events after user is updated (role might have changed)
     */
    public function updated(User $user): void
    {
        // Clear old cache if role changed
        if ($user->isDirty('role_id')) {
            // Get the old role_id from dirty attributes
            $oldRoleId = $user->getOriginal('role_id');

            if ($oldRoleId) {
                PermissionCacheHelper::clearUserPermissionCache($user->id, $oldRoleId);
            }
        }
    }

    /**
     * Handle events after user is deleted
     */
    public function deleted(User $user): void
    {
        if ($user->role_id) {
            PermissionCacheHelper::clearUserPermissionCache($user->id, $user->role_id);
        }
    }
}

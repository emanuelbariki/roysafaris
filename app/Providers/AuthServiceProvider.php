<?php

namespace App\Providers;

use App\Helpers\PermissionCacheHelper;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Observers\PermissionObserver;
use App\Observers\RoleObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register model observers for automatic cache clearing
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
        Permission::observe(PermissionObserver::class);

        if (Schema::hasTable('permissions')) {
            // Use Gate::before to check all permissions at once
            // This avoids N+1 queries by loading user permissions once per request
            Gate::before(function ($user, $ability) {
                if (!$user || !$user->role) {
                    return false;
                }

                // Cache user permissions to avoid repeated queries within cache duration
                $cacheKey = "user_permissions_{$user->id}_role_{$user->role_id}";

                // Track this cache key so we can clear it when permissions change
                PermissionCacheHelper::trackUserPermissionCache($cacheKey);

                $permissions = Cache::remember($cacheKey, now()->addHours(6), function () use ($user) {
                    // Load role with permissions in a single query using eager loading
                    return $user->role()->with('permissions')->first()->permissions
                        ->pluck('ability')
                        ->toArray();
                });

                // Check if the user has the required permission
                // Return true if has permission, false to deny
                return in_array($ability, $permissions);
            });

            // Optional: Define explicit gates for IDE autocomplete/documentation
            // These won't cause N+1 because Gate::before handles the actual check
            Cache::remember('all_permissions', now()->addHours(6), function () {
                return Permission::all();
            });

            foreach (Cache::get('all_permissions') as $permission) {
                Gate::define($permission->ability, function ($user) use ($permission) {
                    // This will be handled by Gate::before, but we define it
                    // for explicit permission checking and IDE autocomplete
                    return true;
                });
            }
        }
    }
}

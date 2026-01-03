<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class PermissionCacheHelper
{
    /**
     * Clear all permission-related caches
     */
    public static function clearPermissionCache(): void
    {
        // Clear all permissions cache
        Cache::forget('all_permissions');

        // Clear all user permission caches
        $keys = Cache::get('user_permission_cache_keys', []);

        foreach ($keys as $key) {
            Cache::forget($key);
        }

        // Clear the cache keys tracker
        Cache::forget('user_permission_cache_keys');
    }

    /**
     * Clear permissions for a specific user
     */
    public static function clearUserPermissionCache(int $userId, int $roleId): void
    {
        $cacheKey = "user_permissions_{$userId}_role_{$roleId}";
        Cache::forget($cacheKey);

        // Also remove from the keys tracker
        $keys = Cache::get('user_permission_cache_keys', []);
        $keys = array_filter($keys, function ($key) use ($cacheKey) {
            return $key !== $cacheKey;
        });
        Cache::put('user_permission_cache_keys', $keys);
    }

    /**
     * Track a user permission cache key
     */
    public static function trackUserPermissionCache(string $cacheKey): void
    {
        $keys = Cache::get('user_permission_cache_keys', []);
        $keys[] = $cacheKey;
        Cache::put('user_permission_cache_keys', array_unique($keys));
    }
}

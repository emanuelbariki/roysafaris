<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

abstract class Controller
{
    protected function extendedView(string $view, array $data, string $title)
    {
        // Get and filter sidebar menu
        $sidebarMenu = $this->getSidebarMenu();
        $sidebarMenu = $this->filterSidebarMenu($sidebarMenu);

        return view($view, array_merge($data, [
            'title' => ucwords($title),
            'gate' => Gate::class,
            'sidebarMenu' => $sidebarMenu,
        ]));
    }

    /**
     * Get sidebar menu configuration with permissions, links, and icons
     */
    protected function getSidebarMenu(): array
    {
        // In development, always load fresh config
        // In production, use cached config for performance
        if (config('app.env') === 'local' || config('app.debug')) {
            // Clear and reload config
            config()->set('sidebar', require config_path('sidebar.php'));
        }

        return config('sidebar', []);
    }

    /**
     * Filter menu items based on user permissions
     */
    protected function filterSidebarMenu(array $menu): array
    {
        $filtered = [];

        foreach ($menu as $item) {
            // Check if user has access to this item
            if (! $this->checkMenuPermission($item)) {
                continue;
            }

            // If it has children, filter them too
            if (isset($item['children']) && is_array($item['children'])) {
                $item['children'] = $this->filterSidebarMenu($item['children']);

                // Only show parent if at least one child is visible
                if (empty($item['children'])) {
                    continue;
                }
            }

            $filtered[] = $item;
        }

        return $filtered;
    }

    /**
     * Check if user has permission for menu item
     */
    protected function checkMenuPermission(array $item): bool
    {
        if (! isset($item['permission'])) {
            return true;
        }

        $permission = $item['permission'];

        // Handle canany (array of permissions)
        if (isset($item['permission_type']) && $item['permission_type'] === 'canany') {
            if (is_array($permission)) {
                foreach ($permission as $perm) {
                    if (Gate::check($perm)) {
                        return true;
                    }
                }

                return false;
            }
        }

        // Handle can (single permission)
        if (is_string($permission)) {
            return Gate::check($permission);
        }

        return true;
    }

    protected function authorize(string $permission)
    {
        return Gate::authorize($permission);
    }
}

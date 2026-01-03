<?php

return [
    [
        'label' => 'Main',
        'is_label' => true,
    ],
    [
        'name' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => 'home',
        'permission' => null, // No permission required
        'active_routes' => ['dashboard'],
    ],
    [
        'name' => 'Fleet Management',
        'icon' => 'navigation',
        'permission' => null,
        'permission_type' => null, // Use @canany directive
        'active_routes' => ['roles.*'],
        'is_dropdown' => true,
        'children' => [
            [
                'name' => 'Fleets',
                'route' => 'fleets.index',
                'icon' => 'ti-control-record',
                'permission' => null,
                'permission_type' => 'can',
                'active_routes' => ['fleets.index'],
            ],
            [
                'name' => 'Types',
                'route' => 'fleettypes.index',
                'icon' => 'ti-control-record',
                'permission' => null,
                'permission_type' => 'can',
                'active_routes' => ['fleettypes.*'],
            ],
            [
                'name' => 'Classes',
                'route' => 'fleetclasses.index',
                'icon' => 'ti-control-record',
                'permission' => null,
                'permission_type' => 'can',
                'active_routes' => ['fleetclasses.*'],
            ],
        ],
    ],
    [
        'name' => 'User management',
        'icon' => 'users',
        'permission' => ['user::manage', 'role::manage', 'permission::manage'],
        'permission_type' => 'canany', // Use @canany directive
        'active_routes' => ['users.*'],
        'is_dropdown' => true,
        'children' => [
            [
                'name' => 'Users',
                'route' => 'users.index',
                'icon' => 'ti-control-record',
                'permission' => 'user::manage',
                'permission_type' => 'can',
                'active_routes' => ['users.*'],
            ],
            [
                'name' => 'Roles',
                'route' => 'roles.index',
                'icon' => 'ti-control-record',
                'permission' => 'role::manage',
                'permission_type' => 'can',
                'active_routes' => ['roles.*'],
            ],
            [
                'name' => 'Permission',
                'route' => 'permissions.index',
                'icon' => 'ti-control-record',
                'permission' => 'permission::manage',
                'permission_type' => 'can',
                'active_routes' => ['permissions.*'],
            ],
        ],
    ],
];

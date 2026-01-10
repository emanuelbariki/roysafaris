<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\SystemModule;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     */
    public function index(): View
    {
        $roles = Role::with('permissions')
            ->withCount('permissions')
            ->orderBy('name')
            ->get();

        return $this->extendedView('roles.index', compact('roles'), 'roles');
    }

    /**
     * Show the form for creating a new role.
     */
    public function create(): View
    {
        $modules = SystemModule::with('permissions')
            ->orderBy('slug')
            ->get();

        return $this->extendedView('roles.create', compact('modules'), 'create role');
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Sync permissions
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role): View
    {
        $modules = SystemModule::with('permissions')
            ->orderBy('slug')
            ->get();

        // Get role's permission IDs for easy checking in view
        $rolePermissionIds = $role->permissions->pluck('id')->toArray();

        return $this->extendedView('roles.edit', compact('role', 'modules', 'rolePermissionIds'), 'edit role');
    }

    /**
     * Update the specified role in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Sync permissions
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            // If no permissions selected, detach all
            $role->detachPermissions();
        }

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        // Check if the role is assigned to any user
        if ($role->users()->count() > 0) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Cannot delete role as it is assigned to one or more users.');
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}

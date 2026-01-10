<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use App\Models\SystemModule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * Display a listing of permissions grouped by module.
     */
    public function index(): View
    {
        logger("The permissions are here");
        $data['permissions'] = Permission::with('systemModule')
            ->orderBy('system_module_id')
            ->orderBy('ability')
            ->get();

        $data['modules'] = SystemModule::with('permissions')
            ->orderBy('slug')
            ->get();

        return $this->extendedView('permissions.index', $data, 'permissions');
    }

    /**
     * Store a newly created permission in storage.
     */
    public function store(StorePermissionRequest $request): RedirectResponse
    {
        Permission::create($request->validated());

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Show the form for creating a new permission.
     */
    public function create(): View
    {
        $modules = SystemModule::orderBy('slug')->get();

        return $this->extendedView('permissions.create', compact('modules'), 'create permission');
    }

    /**
     * Show the form for editing the specified permission.
     */
    public function edit(Permission $permission): View
    {
        $modules = SystemModule::orderBy('slug')->get();

        return $this->extendedView('permissions.edit', compact('permission', 'modules'), 'edit permission');
    }

    /**
     * Update the specified permission in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->validated());

        // Redirect back with permission_id for modal re-open on validation error
        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission updated successfully.')
            ->with('permission_id', $permission->id);
    }

    /**
     * Remove the specified permission from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        // Check if the permission is assigned to any role
        if ($permission->roles()->count() > 0) {
            return redirect()
                ->route('permissions.index')
                ->with('error', 'Cannot delete permission as it is assigned to one or more roles.');
        }

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}

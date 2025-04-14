<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $title = "Edit Permission";
        return view('permissions.index', compact('permissions', 'title'));
    }

    public function create()
    {
        $title = "Create Permission";
        return view('permissions.create', compact('title'));
    }

    public function store(Request $request)
    {
        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission created.');
    }

    public function edit(Permission $permission)
    {
        $title = "Edit Permission";
        return view('permissions.edit', compact('permission', 'title'));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        // Check if the permission is assigned to any role
        if ($permission->roles()->count() > 0) {
            return redirect()->route('permissions.index')
                            ->with('error', 'Cannot delete permission as it is assigned to one or more roles.');
        }

        // Proceed with the permission deletion if not assigned
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }

}

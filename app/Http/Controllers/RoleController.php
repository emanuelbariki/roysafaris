<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $title = "Roles";
        return view('roles.index', compact('roles', 'title'));
    }

    public function create()
    {
        $title = "Create Roles";
        $permissions = Permission::all();
        return view('roles.create', compact('permissions','title'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created.');
    }

    public function assignPermission($id, Request $request)
    {
        $this->validate($request, ['permissions' => 'required|array']);
        $role = Role::findOrFail($id);
        $permissions = Permission::whereIn('name', $request->permissions)->get();

        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Permissions updated!');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $title = "Edit Roles";
        return view('roles.edit', compact('role', 'permissions', 'title'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated.');
    }

    public function destroy(Role $role)
        {
            // Check if the role is assigned to any user
            if ($role->users()->count() > 0) {
                return redirect()->route('roles.index')
                                ->with('error', 'Cannot delete role as it is assigned to one or more users.');
            }

            // Proceed with the role deletion if not assigned
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::query()->with('role')->get();
        $data['roles'] = Role::query()->select('id', 'name')->get();

        return $this->extendedView(
            view: 'user.index',
            data: $data,
            title: 'Users'
        );

//        $users = User::with('roles')->get();
//        return view('users.index', compact('users', 'title'));
    }

    public function store(StoreUserRequest $request)
    {
        // Create the user with validated data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    public function create()
    {
        $roles = Role::all();
        $title = "Create Users";
        return view('users.create', compact('roles', 'title'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $title = "Edit Users";

        return view('users.edit', compact('user', 'roles', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'roles' => 'nullable|array',
        ]);

        $user = User::findOrFail($id);
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'Roles updated!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Users";
        $users = User::with('roles')->get();
        return view('users.index', compact('users', 'title'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $title = "Create Users";
        return view('users.create', compact('roles', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'nullable|array'
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        if ($request->roles) {
            $user->assignRole($request->roles);
        }
    
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

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
        $title = 'Create Users';

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
        $title = 'Edit Users';

        return view('users.edit', compact('user', 'roles', 'title'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
            ];

            // Only update password if provided
            if ($request->filled('password')) {
                $updateData['password'] = bcrypt($request->password);
            }

            $user->update($updateData);

            DB::commit();

            return redirect()
                ->route('users.index')
                ->with('flash_success', 'User updated successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error updating user: '.$e->getMessage(), [
                'user_id' => $user->id,
                'request_data' => $request->all(),
                'exception' => $e,
            ]);

            return back()
                ->withInput()
                ->with('flash_error', 'Unable to update user at this time. Please try again.');
        }
    }

    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return redirect()
                ->route('users.index')
                ->with('flash_success', 'User deleted successfully');
        } catch (Throwable $e) {
            DB::rollBack();

            Log::error('Error deleting user: '.$e->getMessage(), [
                'user_id' => $user->id,
                'exception' => $e,
            ]);

            return back()
                ->with('flash_error', 'Unable to delete user at this time. Please try again.');
        }
    }
}

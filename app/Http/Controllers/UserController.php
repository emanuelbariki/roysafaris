<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(): View
    {
        $this->authorize('view::user');

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

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->authorize('create::user');
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

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        $this->authorize('create::user');

        $roles = Role::all();
        $title = 'Create Users';

        return view('users.create', compact('roles', 'title'));
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id): View
    {
        $this->authorize('edit::user');
        $user = User::findOrFail($id);
        $roles = Role::all();
        $title = 'Edit Users';

        return view('users.edit', compact('user', 'roles', 'title'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('edit::user');
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

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete::user');
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

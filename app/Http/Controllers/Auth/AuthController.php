<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    /**
     * Display the login page.
     */
    public function login()
    {
        Log::info('User requested the login page.');

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function do_login(Request $request)
    {
        Log::info('Login attempt started.', ['email' => $request->email]);

        // Validate the login credentials
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        Log::info('Login validation passed.', ['email' => $request->email]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Protect against session fixation attacks
            Log::info('User logged in successfully.', ['email' => $request->email]);

            return redirect()->intended('dashboard');
        }

        Log::warning('Login attempt failed.', ['email' => $request->email]);

        // Return an error if authentication fails
        throw ValidationException::withMessages([
            'email' => __('The provided credentials are incorrect.'),
        ]);
    }

    /**
     * Log out the user.
     */
    public function logout(Request $request)
    {
        Log::info('User logged out.', ['email' => Auth::user() ? Auth::user()->email : 'Guest']);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', __('You have been logged out.'));
    }

    /**
     * Display the registration page.
     */
    public function register()
    {
        return view('auth.login');
    }

    /**
     * Handle the registration request.
     */
    public function do_register(Request $request)
    {
        Log::info('Registration attempt started.', ['email' => $request->email]);

        // Validate the registration input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'], // 'confirmed' expects a 'password_confirmation' field
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Log::info('New user created.', ['email' => $user->email]);

        // Log the user in after registration
        Auth::login($user);

        Log::info('User logged in after registration.', ['email' => $user->email]);

        return redirect('dashboard')->with('status', __('Registration successful.'));
    }
}

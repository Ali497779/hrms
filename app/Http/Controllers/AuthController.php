<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginAttempt(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // If invalid credentials
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid email or password.');
        }

        
        // Determine role and login with appropriate guard
        if ($user->is_admin) {
            Auth::guard('admin')->login($user);
            session(['guard' => 'admin']); // <<< track it
            return redirect()->route('admin.dashboard');
        } elseif ($user->is_customer) {
            Auth::guard('customer')->login($user);
            session(['guard' => 'customer']);
            return redirect()->route('customer.dashboard');
        } elseif ($user->is_sales) {
            Auth::guard('sales')->login($user);
            session(['guard' => 'sales']);
            return redirect()->route('sales.dashboard');
        } elseif ($user->is_projectmanager) {
            Auth::guard('projectmanager')->login($user);
            session(['guard' => 'projectmanager']);
            return redirect()->route('pm.dashboard');
        } elseif ($user->is_developer) {
            Auth::guard('developer')->login($user);
            session(['guard' => 'developer']);
            return redirect()->route('developer.dashboard');
        } elseif ($user->is_designer) {
            Auth::guard('designer')->login($user);
            session(['guard' => 'designer']);
            return redirect()->route('designer.dashboard');
        }

        // If no valid role
        return redirect()->back()->with('error', 'Role not assigned.');
    }

    public function logout(Request $request)
    {
        // Log out from all guards if using multi-auth
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
            }
        }

        // Clear session data
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // CSRF token

        // Redirect to login or homepage
        return redirect()->route('login');
    }
}

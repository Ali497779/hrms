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
            return redirect()->route('admin.dashboard');
        } elseif ($user->is_customer) {
            Auth::guard('customer')->login($user);
            return redirect()->route('customer.dashboard');
        } elseif ($user->is_sales) {
            Auth::guard('sales')->login($user);
            return redirect()->route('sales.dashboard');
        } elseif ($user->is_projectmanager) {
            Auth::guard('projectmanager')->login($user);
            return redirect()->route('pm.dashboard');
        } elseif ($user->is_developer) {
            Auth::guard('developer')->login($user);
            return redirect()->route('developer.dashboard');
        }

        // If no valid role
        return redirect()->back()->with('error', 'Role not assigned.');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}

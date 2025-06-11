<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
    {
        $guard = session('guard', 'web');
        $user = Auth::guard($guard)->user();

        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        if ($user->is_admin) {
            $payrolls = Payroll::with('user')->orderBy('id', 'desc')->get();
            $users = User::get();
        } else {
            $payrolls = Payroll::where('user_id', $user->id)->orderBy('id', 'desc')->get();
            $users = User::where('id', $user->id)->get();
        }

        return view("payroll.list", compact("payrolls","users"));
    }

    public function create()
    {
        $guard = session('guard', 'web');
        $user = Auth::guard($guard)->user();

        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        if ($user->is_admin) {
            $users = User::get();
        } else {
            $users = User::where('id', $user->id)->get();
        }
        return view("payroll.create", compact("users"));

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Payroll $payroll)
    {
        //
    }

    public function edit(Payroll $payroll)
    {
        //
    }

    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    public function destroy(Payroll $payroll)
    {
        //
    }
}

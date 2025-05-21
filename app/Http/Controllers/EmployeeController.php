<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Mail\EmployeeWelcomeEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'avatar' => 'nullable|image',
                'designation' => 'required|string|max:50',
            ], [
                'password.confirmed' => 'The password confirmation does not match.',
                'email.unique' => 'This email is already registered.',
            ]);

            // Create user with the correct role flag
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_developer' => true,
            ];

            $user = User::create($userData);

            // Handle avatar upload
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('public/assets/employee');
                $avatarPath = str_replace('public/', '', $avatarPath);
            }

            // Create employee
            $designationMap = [
                'is_sales' => 'Sales',
                'is_developer' => 'Developer',
                'is_projectmanager' => 'Project Manager'
            ];
            
            $employeeData = $request->except(['name', 'email', 'password', 'password_confirmation', 'avatar']);
            $employeeData['user_id'] = $user->id;
            $employeeData['avatar'] = $avatarPath;
            $employeeData['designation'] = $designationMap[$request->designation] ?? $request->designation;
            
            Employee::create($employeeData);

            // Send welcome email with proper from address
            Mail::to($user->email)
                ->send((new EmployeeWelcomeEmail($user))
                ->from(config('mail.from.address'), config('mail.from.name')));

            return redirect()->route('employee.list')->with('success', 'Employee created successfully!');
            
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('validation_errors', 'Please fix the errors below.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

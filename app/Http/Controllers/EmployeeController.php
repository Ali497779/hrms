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

    public function index()
    {
        $employees = Employee::with(['user:id,name,email'])->get();
        return view('employee.list', compact('employees'));
    }


    public function create()
    {
        return view('employee.create');
    }


   public function store(Request $request)
    {
        try {
            // Step 1: Validate request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'avatar' => 'nullable|image',
                'designation' => 'required|string|max:50',
                'address' => 'nullable',
                'phone' => 'nullable',
                'date_of_birth' => 'nullable',
            ], [
                'password.confirmed' => 'The password confirmation does not match.',
                'email.unique' => 'This email is already registered.',
            ]);

            // Step 2: Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                $request->designation => true,
            ]);

            // Step 3: Handle avatar upload to public/assets/images/employee/
            $avatarName = null;
            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                $avatarFile = $request->file('avatar');
                $avatarName = uniqid() . '.' . $avatarFile->getClientOriginalExtension();
                $avatarFile->move(public_path('assets/images/employee'), $avatarName);
            }

            // Step 4: Map designation
            $designationMap = [
                'is_sales' => 'Sales',
                'is_developer' => 'Developer',
                'is_projectmanager' => 'Project Manager'
            ];

            // Step 5: Prepare employee data
            $employeeData = $request->except([
                'name', 'email', 'password', 'password_confirmation', 'avatar'
            ]);
            $employeeData['user_id'] = $user->id;
            $employeeData['avatar'] = $avatarName; // store only filename
            $employeeData['designation'] = $designationMap[$request->designation] ?? $request->designation;

            // Step 6: Create employee
            Employee::create($employeeData);

            // Step 7: Send welcome email
            Mail::to($user->email)
                ->send((new EmployeeWelcomeEmail($user))
                ->from(config('mail.from.address'), config('mail.from.name')));

            // Step 8: Redirect with success
            return redirect()->route('employee.list')->with('success', 'Employee created successfully!');
            
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('validation_errors', 'Please fix the errors below.');
        }
    } 


    public function detail($id)
    {
        $employeeId = $id;
        $employee = Employee::with('user')->findOrFail($employeeId);

        // Return a view or JSON as needed, e.g.:
        return view('employee.detail', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::with('user')->findOrFail($id);
        // Pass employee data to the edit view
        return view('employee.edit', compact('employee'));
    }


    public function update(Request $request, $id)
    {
        
        try {
            $employee = Employee::findOrFail($id);
            $user = User::findOrFail($employee->user_id);
            
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                ],
                'avatar' => 'nullable|image',
                'designation' => 'required|string|max:50',
                'address' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'date_of_birth' => 'nullable',
                'password' => 'nullable|string|min:6|confirmed',
            ]);

            
            // Update user data
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $password = Hash::make($request->password);
            }
            User::where('id', $employee->user_id)->update([
                'name' => $request->name,
                'email'=> $request->email,
                'password' => $request->password ?? $user->password,
                $request->designation => true
            ]);

            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                if ($employee->avatar && file_exists(public_path('assets/images/employee/' . $employee->avatar))) {
                    unlink(public_path('assets/images/employee/' . $employee->avatar));
                }

                $avatarFile = $request->file('avatar');
                $avatarName = uniqid() . '.' . $avatarFile->getClientOriginalExtension();
                $avatarFile->move(public_path('assets/images/employee'), $avatarName);
                $employee->avatar = $avatarName;
            }

            $designationMap = [
                'is_sales' => 'Sales',
                'is_developer' => 'Developer',
                'is_projectmanager' => 'Project Manager'
            ];

            $employee->designation = $designationMap[$request->designation] ?? $request->designation;

            $employee->phone = $request->phone ?? $employee->phone;
            $employee->date_of_birth = $request->date_of_birth ?? $employee->date_of_birth;

            $employee->save();

            return redirect()->route('employee.list')->with('success', 'Employee updated successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('validation_errors', 'Please fix the errors below.');
        }
    }


    public function delete($id)
    {
        $employee = Employee::findOrFail($id);

        // Delete avatar from file system
        if ($employee->avatar && file_exists(public_path('assets/images/employee/' . $employee->avatar))) {
            unlink(public_path('assets/images/employee/' . $employee->avatar));
        }

        // Delete user associated with employee
        User::where('id', $employee->user_id)->delete();

        // Delete employee
        $employee->delete();

        return redirect()->route('employee.list')->with('success', 'Employee deleted successfully.');
    }
}

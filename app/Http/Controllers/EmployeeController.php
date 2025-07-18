<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\PublicHoliday;
use App\Mail\EmployeeWelcomeEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

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
                'designation' => 'required|string',
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
                'is_projectmanager' => 'Project Manager',
                'is_designer' => 'Designer'
            ];

            // Step 5: Prepare employee data
            $employeeData = $request->except([
                'name', 'email', 'password', 'password_confirmation', 'avatar'
            ]);
            $employeeData['user_id'] = $user->id;
            $employeeData['avatar'] = $avatarName; // store only filename
            $employeeData['designation'] = $designationMap[$request->designation] ?? $request->designation;
            $employeeData['salary'] = $request->salary;
            $employeeData['comission'] = $request->comission;

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

    public function calender($id, $month = null, $year = null)
    {
        $employee = Employee::with('user')->findOrFail($id);

        $currentMonth = $month ?? now()->month;
        $currentYear = $year ?? now()->year;

        $attendances = Attendance::where('user_id', $employee->user_id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->get();

        $holidays = PublicHoliday::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->get();

        return view('employee.calender', compact('employee', 'attendances', 'holidays', 'currentMonth', 'currentYear'));
    }

    public function myCalender($month = null, $year = null){
        $id = Auth::user()->id;

        $employee = Employee::with('user')->where('user_id', $id)->first();

        $currentMonth = $month ?? now()->month;
        $currentYear = $year ?? now()->year;

        $attendances = Attendance::where('user_id', $employee->user_id)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->get();

        $holidays = PublicHoliday::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->get();

        return view('employee.mycalender', compact('employee', 'attendances', 'holidays', 'currentMonth', 'currentYear'));
    }

    public function myPayslip(){
        return view('employee.mypayslip', );
    }

    public function PayslipDownload(Request $request)
    {
        try {
            // Step 1: Validate request
            $request->validate([
                'date' => 'required|date',
            ]);

            // Step 2: Extract year and month
            $date = Carbon::parse($request->date);
            $year = $date->format('Y');
            $month = $date->format('m');

            // Step 3: Construct path to file
            $userId = Auth::user()->id;
            $filePath = "payroll/payslips/{$userId}_{$year}_{$month}.pdf";

            // Step 4: Check if file exists and return download
            if (Storage::disk('public')->exists($filePath)) {
                return Storage::disk('public')->download($filePath);
            } else {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Payslip file is not available.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An unexpected error occurred.');
        }
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
            $employee->salary = $request->salary ?? $employee->salary;
            $employee->comission = $request->comission ?? $employee->comission;

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

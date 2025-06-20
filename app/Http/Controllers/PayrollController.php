<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Dollar;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PublicHoliday;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::selectRaw('month, MAX(generated_at) as latest_generated_at')
            ->groupBy('month')
            ->orderByDesc('month')
            ->get();

        return view('payroll.list', compact('payrolls'));
    }

    public function create()
    {
        $guard = session('guard', 'web');
        $user = Auth::guard($guard)->user();

        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        if ($user->is_admin) {
            $users = Employee::with('user')->get();
        } else {
            $users = User::where('id', $user->id)->get();
        }
        return view("payroll.create", compact("users"));

    }

    public function store(Request $request)
    {
        $date = $request->date; // "2025-06"
        [$year, $month] = explode('-', $date);
        $usdToPkrRate = (int) Dollar::latest()->first()->rate;
        $reportData = [];

        // Get all public holidays for the month
        $holidays = PublicHoliday::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->pluck('date')
            ->map(fn ($date) => Carbon::parse($date)->toDateString())
            ->toArray();

        foreach ($request->members as $member) {
            $employee = Employee::with('user')->findOrFail($member);
            
            // Per day salary (fixed 30 days as per requirement)
            $perDaySalary = $employee->salary / 30;

            // Get attendance records
            $attendanceRecords = Attendance::where('user_id', $employee->user_id)
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->get();

            // Count ONLY explicit present/absent days
            $presentDays = $attendanceRecords->where('status', 'Present')->count();
            $absentDays = $attendanceRecords->where('status', 'Absent')->count();
            $holidayDays = count($holidays);

            // Calculate commission
            $sales = Sale::where(['createdby'=> $employee->user_id, 'status' => 'paid'])
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();

            $commissionUSD = $sales->sum(fn ($sale) => ($employee->comission / 100) * $sale->total_amount);
            $commissionPKR = $commissionUSD * $usdToPkrRate;

            // Salary calculations
            $earnedSalary = $presentDays * $perDaySalary;
            $holidayPay = $holidayDays * $perDaySalary;
            $deduction = $absentDays * $perDaySalary;
            $totalPay = $earnedSalary + $holidayPay + $commissionPKR - $deduction;

            // Create payroll record
            Payroll::create([
                'user_id' => $employee->user_id,
                'month' => "$year-$month",
                'base_salary' => round($earnedSalary + $holidayPay, 2),
                'commission' => round($commissionPKR, 2),
                'deduction' => round($deduction, 2),
                'total_pay' => round($totalPay, 2),
                'generated_at' => now(),
            ]);

            // Report data
            $reportData[] = [
                'Employee Name' => $employee->user->name ?? 'N/A',
                'Monthly Salary' => round($employee->salary, 2),
                'Per Day Salary' => round($perDaySalary, 2),
                'Present Days' => $presentDays,
                'Absent Days' => $absentDays,
                'Holidays' => $holidayDays,
                'Base Salary' => round($earnedSalary, 2),
                'Holiday Pay' => round($holidayPay, 2),
                'Commission Amount' => round($commissionPKR, 2),
                'Deduction' => round($deduction, 2),
                'Total Payroll Amount' => round($totalPay, 2),
            ];
        }

        // Generate CSV (same as before)
        $filename = "Payroll{$month}-{$year}.csv";
        $csvData = "\xEF\xBB\xBF" . implode(',', array_keys($reportData[0])) . "\n";
        
        foreach ($reportData as $row) {
            $csvData .= implode(',', array_map(fn ($v) => '"' . str_replace('"', '""', $v) . '"', $row)) . "\n";
        }

        Storage::disk('public')->put("payroll/$filename", $csvData);
        
        return view('payroll.download', [
            'fileUrl' => asset("storage/payroll/$filename"),
            'redirectUrl' => route('payroll.list'),
            'message' => 'Payroll generated successfully!'
        ]);
    }

    public function check(){
        return view('payroll.check');
    }

    public function checkpost(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m',
        ]);

        [$year, $month] = explode('-', $request->date);

        $userId = Auth::id();
        $employee = Employee::where('user_id', $userId)->first();

        if (!$employee) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }

        $perDaySalary = $employee->salary / 30;
        $usdToPkrRate = (int) Dollar::latest()->first()?->rate ?? 278;

        $holidays = PublicHoliday::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->pluck('date')
            ->map(fn ($date) => Carbon::parse($date)->toDateString())
            ->toArray();

        $attendanceRecords = Attendance::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $presentDays = $attendanceRecords->where('status', 'Present')->count();
        $absentDays = $attendanceRecords->where('status', 'Absent')->count();
        $holidayDays = count($holidays);

        $sales = Sale::where('createdby', $userId)
            ->where('status', 'paid')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $commissionUSD = $sales->sum(fn ($sale) => ($employee->comission / 100) * $sale->total_amount);
        $commissionPKR = $commissionUSD * $usdToPkrRate;

        $earnedSalary = $presentDays * $perDaySalary;
        $holidayPay = $holidayDays * $perDaySalary;
        $deduction = $absentDays * $perDaySalary;
        $totalPay = $earnedSalary + $holidayPay + $commissionPKR - $deduction;

        return response()->json([
            'date' => Carbon::create($year, $month)->format('F Y'),
            'present_days' => $presentDays,
            'absent_days' => $absentDays,
            'holiday_days' => $holidayDays,
            'per_day_salary' => round($perDaySalary),
            'earned_salary' => round($earnedSalary),
            'holiday_pay' => round($holidayPay),
            'deduction' => round($deduction),
            'commission' => round($commissionPKR),
            'total_pay' => round($totalPay),
        ]);
    }

    public function show(Request $request)
    {
        $payrolls = Payroll::where('month', $request->month)->with('user')->get();
        return view('payroll.detail', ['payrolls' => $payrolls]);
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

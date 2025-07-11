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
use Barryvdh\DomPDF\Facade\Pdf;

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
        $usdToPkrRate = (int) Dollar::latest()->first()?->rate ?? 278;
        $reportData = [];

        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $daysInMonth = $endOfMonth->day;

        // Get all public holidays for the month
        $holidays = PublicHoliday::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->pluck('date')
            ->map(fn ($date) => Carbon::parse($date)->toDateString())
            ->toArray();

        // Get all Sat/Sun dates of the month
        $weekendDays = [];
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $formattedDate = $date->toDateString();
            if (($date->isSaturday() || $date->isSunday()) && !in_array($formattedDate, $holidays)) {
                $weekendDays[] = $formattedDate;
            }
        }

        foreach ($request->members as $member) {
            $employee = Employee::with('user')->findOrFail($member);
            $monthlySalary = $employee->salary;
            $perDaySalary = $monthlySalary / $daysInMonth;

            // Attendance records
            $attendanceRecords = Attendance::where('user_id', $employee->user_id)
                ->whereYear('date', $year)
                ->whereMonth('date', $month)
                ->get();

            $presentDays = $attendanceRecords->where('status', 'Present')->count();
            $absentDays = $attendanceRecords->where('status', 'Absent')->count();

            $recordedDates = $attendanceRecords->pluck('date')
                ->map(fn ($d) => Carbon::parse($d)->toDateString())
                ->toArray();

            $unrecordedWeekendDays = collect($weekendDays)->reject(fn ($date) => in_array($date, $recordedDates))->count();
            $unrecordedHolidayDays = collect($holidays)->reject(fn ($date) => in_array($date, $recordedDates))->count();

            $payableDays = $presentDays + $unrecordedWeekendDays + $unrecordedHolidayDays;
            $netPayableDays = min($daysInMonth, $payableDays);

            // Commission
            $sales = Sale::where('createdby', $employee->user_id)
                ->where('status', 'paid')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();

            $commissionUSD = $sales->sum(fn ($sale) => ($employee->comission / 100) * $sale->total_amount);
            $commissionPKR = $commissionUSD * $usdToPkrRate;

            // Tax calculation
            $salary = $employee->salary;
            $tax = 0;
            if ($salary <= 50000) {
                $tax = 0;
            } elseif ($salary <= 100000) {
                $tax = ($salary - 50000) * 0.05;
            } elseif ($salary <= 183333) {
                $tax = 2500 + ($salary - 100000) * 0.15;
            } elseif ($salary <= 266667) {
                $tax = 12500 + ($salary - 183333) * 0.25;
            } elseif ($salary <= 341667) {
                $tax = 32500 + ($salary - 266667) * 0.30;
            } else {
                $tax = 54500 + ($salary - 341667) * 0.35;
            }

            // Salary calculations
            $earnedSalary = $netPayableDays * $perDaySalary;
            $deduction = $absentDays * $perDaySalary;
            $totalPay = $earnedSalary + $commissionPKR - $tax;


            // Create payroll record
            $payroll = Payroll::create([
                'user_id' => $employee->user_id,
                'month' => "$year-$month",
                'base_salary' => round($earnedSalary, 2),
                'commission' => round($commissionPKR, 2),
                'deduction' => round($deduction, 2),
                'total_tax' => round($tax, 2),
                'total_pay' => round($totalPay, 2),
                'generated_at' => now(),
            ]);

            // Generate secured payslip PDF
            $payslipPath = "payroll/payslips/{$employee->user_id}_{$year}_{$month}.pdf";
            $pdf = PDF::loadView('payroll.payslip', [
                'employee' => $employee,
                'payroll' => $payroll,
                'monthName' => Carbon::parse("$year-$month-01")->format('F Y'),
            ]);

            if (Storage::disk('public')->exists($payslipPath)) {
                Storage::disk('public')->delete($payslipPath);
            }
            Storage::disk('public')->put($payslipPath, $pdf->output());

            $reportData[] = [
                'Employee Name' => $employee->user->name ?? 'N/A',
                'Monthly Salary' => round($monthlySalary, 2),
                'Days in Month' => $daysInMonth,
                'Per Day Salary' => round($perDaySalary, 2),
                'Present Days' => $presentDays,
                'Absent Days' => $absentDays,
                'Unrecorded Holidays' => $unrecordedHolidayDays,
                'Unrecorded Weekends' => $unrecordedWeekendDays,
                'Paid Days' => $netPayableDays,
                'Base Salary' => round($earnedSalary, 2),
                'Holiday Pay' => round($unrecordedHolidayDays * $perDaySalary, 2),
                'Commission Amount' => round($commissionPKR, 2),
                'Deduction' => round($deduction, 2),
                'Income Tax' => round($tax, 2),
                'Total Payroll Amount' => round($totalPay, 2),
            ];
        }

        
        $filename = "Payroll{$month}-{$year}.csv";
        $csvPath = "payroll/$filename";

        // Delete existing CSV if exists
        if (Storage::disk('public')->exists($csvPath)) {
            Storage::disk('public')->delete($csvPath);
        }

        $csvData = "\xEF\xBB\xBF" . implode(',', array_keys($reportData[0])) . "\n";
        foreach ($reportData as $row) {
            $csvData .= implode(',', array_map(fn ($v) => '"' . str_replace('"', '""', $v) . '"', $row)) . "\n";
        }
        Storage::disk('public')->put($csvPath, $csvData);

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

        $monthlySalary = $employee->salary;


        $salary = $employee->salary;
        $tax = 0;

        if ($salary <= 50000) {
            $tax = 0;
        } elseif ($salary <= 100000) {
            $tax = ($salary - 50000) * 0.05;
        } elseif ($salary <= 183333) {
            $tax = 2500 + ($salary - 100000) * 0.15;
        } elseif ($salary <= 266667) {
            $tax = 12500 + ($salary - 183333) * 0.25;
        } elseif ($salary <= 341667) {
            $tax = 32500 + ($salary - 266667) * 0.30;
        } else {
            $tax = 54500 + ($salary - 341667) * 0.35;
        }

        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $daysInMonth = $endOfMonth->day;
        $perDaySalary = $monthlySalary / $daysInMonth;

        $usdToPkrRate = (int) Dollar::latest()->first()?->rate ?? 278;

        
        // Get holidays
        $holidays = PublicHoliday::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->pluck('date')
        ->map(fn($d) => Carbon::parse($d)->toDateString())
        ->toArray();
        
        $holidayDays = count($holidays);
        

        // Get all Sat/Sun dates that are NOT holidays
        $weekendDays = [];
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $formattedDate = $date->toDateString();
            if (($date->isSaturday() || $date->isSunday()) && !in_array($formattedDate, $holidays)) {
                $weekendDays[] = $formattedDate;
            }
        }
        // Get attendance
        $attendanceRecords = Attendance::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $presentDays = $attendanceRecords->where('status', 'Present')->count();
        $absentDays = $attendanceRecords->where('status', 'Absent')->count();

        // Dates already marked in attendance
        $recordedDates = $attendanceRecords->pluck('date')
            ->map(fn($d) => Carbon::parse($d)->toDateString())
            ->toArray();

        // Sat/Sun that are not recorded already
        $unrecordedWeekendDays = collect($weekendDays)->reject(fn($date) => in_array($date, $recordedDates))->count();

        // Holiday days not already recorded
        $unrecordedHolidayDays = collect($holidays)->reject(fn($date) => in_array($date, $recordedDates))->count();

        // Total payable days = Present + unrecorded Sat/Sun + unrecorded Holidays
        $payableDays = $presentDays + $unrecordedWeekendDays + $unrecordedHolidayDays;

        // Deduct absents (you can include this or not depending on policy)
        $netPayableDays = $payableDays; // or - $absentDays if needed

        // Commission
        $sales = Sale::where('createdby', $userId)
            ->where('status', 'paid')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $commissionUSD = $sales->sum(fn($sale) => ($employee->comission / 100) * $sale->total_amount);
        $commissionPKR = $commissionUSD * $usdToPkrRate;

        // Final salary
        $earnedSalary = $netPayableDays * $perDaySalary;
        $totalPay = $earnedSalary + $commissionPKR - $tax;

        return response()->json([
            'month' => $startOfMonth->format('F Y'),
            'salary_days' => $daysInMonth,
            'per_day_salary' => round($perDaySalary),
            'present_days' => $presentDays,
            'absent_days' => $absentDays,
            'weekend_days' => $unrecordedWeekendDays,
            'holiday_days' => $unrecordedHolidayDays,
            'payable_days' => $netPayableDays,
            'earned_salary' => round($earnedSalary),
            'commission' => round($commissionPKR),
            'total_pay' => round($totalPay),
            'holiday_pay' => round($unrecordedHolidayDays * $perDaySalary),
            'total_tax' => round($tax),
            'deduction' => round($absentDays * $perDaySalary),
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

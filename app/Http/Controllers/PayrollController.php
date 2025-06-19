<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
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
        $date = $request->date; // Format: "2025-06"
        [$year, $month] = explode('-', $date);
        $usdToPkrRate = 278;
        $reportData = [];

        $holidays = PublicHoliday::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->pluck('date')
            ->map(fn ($d) => Carbon::parse($d));

        foreach ($request->members as $member) {
            $employee = Employee::with('user')->findOrFail($member);
            $perDaySalary = $employee->salary / 30;

            $start = Carbon::create($year, $month, 1);
            $end = $start->copy()->endOfMonth();

            $validDates = [];
            for ($dateIter = $start->copy(); $dateIter <= $end; $dateIter->addDay()) {
                if (!$dateIter->isWeekend() && !$holidays->contains(fn ($h) => $h->isSameDay($dateIter))) {
                    $validDates[] = $dateIter->toDateString();
                }
            }

            $presentDays = Attendance::where('user_id', $employee->user_id)
                ->where('status', 'Present')
                ->whereIn('date', $validDates)
                ->count();

            $absentDays = Attendance::where('user_id', $employee->user_id)
                ->where('status', 'Absent')
                ->whereIn('date', $validDates)
                ->count();

            $sales = Sale::where('createdby', $employee->user_id)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();

            $commissionUSD = $sales->sum(fn ($sale) => ($employee->comission / 100) * $sale->total_amount);
            $commissionPKR = $commissionUSD * $usdToPkrRate;

            $earnedSalary = $presentDays * $perDaySalary;
            $deduction = $absentDays * $perDaySalary;
            $finalSalary = $earnedSalary + $commissionPKR - $deduction;

            Payroll::create([
                'user_id' => $employee->user_id,
                'month' => "$year-$month",
                'base_salary' => round($earnedSalary, 2),
                'commission' => round($commissionPKR, 2),
                'deduction' => round($deduction, 2),
                'total_pay' => round($finalSalary, 2),
                'generated_at' => now(),
            ]);

            $reportData[] = [
                'Employee Name' => $employee->user->name ?? 'N/A',
                'Per Day Salary' => round($perDaySalary, 2),
                'Total Days' => count($validDates),
                'Basic Salary' => round($earnedSalary, 2),
                'Commission Amount' => round($commissionPKR, 2),
                'Deduction' => round($deduction, 2),
                'Total Payroll Amount' => round($finalSalary, 2),
            ];
        }

        if (empty($reportData)) {
            return back()->with('error', 'No payroll data found.');
        }

        $filename = "Payroll{$month}-{$year}.csv";
        $csvData = '';

        // Add UTF-8 BOM
        $csvData .= "\xEF\xBB\xBF";

        // Generate CSV content
        $csvData .= implode(',', array_keys($reportData[0])) . "\n";
        foreach ($reportData as $row) {
            $csvData .= implode(',', array_map(fn ($v) => '"' . str_replace('"', '""', $v) . '"', $row)) . "\n";
        }

        // Save to storage/app/public/payroll/
        Storage::disk('public')->put("payroll/$filename", $csvData);
        

        // Download file
        $fileUrl = asset("storage/payroll/$filename");

        return view('payroll.download', [
            'fileUrl' => $fileUrl,
            'redirectUrl' => route('payroll.list'),
            'message' => 'Payroll generated successfully!'
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

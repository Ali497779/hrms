<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){

        $user = Auth::user();
        $employee = User::findOrFail($user->id);

        $attendanceDate = $this->getAttendanceDateForNightShift();

        $todayAttendance = Attendance::where('user_id', $employee->id)
        ->where('date', $attendanceDate)
        ->first();

        return view('admin.index', compact('todayAttendance'));
    }

    private function getAttendanceDateForNightShift()
    {
        $now = Carbon::now();

        // Define night shift start (20:00) and end (06:00)
        $shiftStart = Carbon::createFromTime(20, 0, 0); // today 8 PM
        $shiftEnd = Carbon::createFromTime(6, 0, 0)->addDay(); // next day 6 AM

        // If current time is between midnight and 6 AM, consider attendance date as previous day
        if ($now->between($shiftStart, $shiftEnd)) {
            if ($now->hour < 6) {
                return $now->copy()->subDay()->toDateString(); // previous day date
            }
        }

        return $now->toDateString();
    }
}

<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // Fixed office location
    private const OFFICE_LAT = 24.898602520897146;
    private const OFFICE_LNG = 67.11660819652492;

   public function checkIn(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // dd($request->all());

        $user = Auth::user();
        $employee = User::findOrFail($user->id);

        $radius = 10.0; // KM
        $distance = $this->haversine($request->latitude, $request->longitude, self::OFFICE_LAT, self::OFFICE_LNG);

        if ($distance > $radius) {
            // Round distance to 2 decimals for user-friendly display
            $distanceFormatted = number_format($distance, 2);
            return back()->with('error', "Check-in failed: You're {$distanceFormatted} KM far away from the office.");
        }

        Attendance::updateOrCreate(
            ['user_id' => $employee->id, 'date' => Carbon::today()],
            ['check_in_time' => now(), 
            'status' => 'Present',
            'latitude' => $request->latitude,
            'longitude'=> $request->longitude
            ],
        );

        return back()->with('success', 'Check-in successful.');
    }

    public function checkOut()
    {
        $user = auth()->user();
        $employee = User::findOrFail($user->id);

        Attendance::where('user_id', $employee->id)
            ->where('date', Carbon::today())
            ->update(['check_out_time' => now()]);

        return back()->with('success', 'Check-out successful.');
    }


    private function isWithinLocation($userLat, $userLng, $officeLat, $officeLng)
    {
        $radius = 5.0; // kilometers
        $distance = $this->haversine($userLat, $userLng, $officeLat, $officeLng);
        return $distance <= $radius;
    }

    private function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth's radius in KM

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) ** 2 +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c; // distance in kilometers
    }

}

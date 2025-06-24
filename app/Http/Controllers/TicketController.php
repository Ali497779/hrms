<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketStatusNotification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function index()
    {
        $guard = session('guard', 'web'); // Use default 'web' if guard not set
        $user = Auth::guard($guard)->user();

        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        if ($user->is_admin) {
            $tickets = Ticket::with('user')->orderBy('date', 'desc')->get(); // All tickets
        } else {
            $tickets = Ticket::where('user_id', $user->id)->orderBy('date', 'desc')->get(); // Only user's tickets
        }

        return view('ticket.list', compact('tickets'));
    }

    public function create()
    {
        return view('ticket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:d-m-Y',
            'reason' => 'required|string|max:255',
        ]);

        $formattedDate = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'date' => $formattedDate,
            'reason' => $request->reason,
        ]);

        // Notify admins
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            $admin->notify(new TicketCreatedNotification($ticket, auth()->user()));
        }

        return back()->with('success', 'Ticket submitted successfully!');
    }

    public function approve($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'Approved';
        $ticket->save();

        // Set check-in and check-out time for night shift (6 PM to 3 AM next day)
        $checkInTime = '18:00:00';
        $checkOutTime = '03:00:00';

        // Check-out date is one day after ticket date
        $checkOutDate = \Carbon\Carbon::parse($ticket->date)->addDay()->format('Y-m-d');

        Attendance::updateOrCreate(
            ['user_id' => $ticket->user_id, 'date' => $ticket->date],
            [
                'status' => 'Present',
                'check_in_time' => $checkInTime,
                'check_out_time' => $checkOutDate . ' ' . $checkOutTime,
                'longitude' => '67.1055872',
                'latitude' => '24.9626624'
            ]
        );

        // Notify user
        $ticket->user->notify(new TicketStatusNotification($ticket, 'Approved'));

        return redirect()->back()->with('success', 'Ticket approved and attendance marked as Present.');
    }

    public function reject($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'Rejected';
        $ticket->save();

        Attendance::updateOrCreate(
            ['user_id' => $ticket->user_id, 'date' => $ticket->date],
            [
                'status' => 'Absent',
                'check_in_time' => null,
                'check_out_time' => null,
                'longitude' => null,
                'latitude' => null
            ]
        );

        // Notify user
        $ticket->user->notify(new TicketStatusNotification($ticket, 'Rejected'));

        return redirect()->back()->with('error', 'Ticket rejected and attendance marked as Absent.');
    }
}



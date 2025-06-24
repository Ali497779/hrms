<?php

namespace App\Notifications;

use Carbon\Carbon;  // This is the correct import statement
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class TicketStatusNotification extends Notification
{
    use Queueable;

    public $ticket;
    public $status;

    public function __construct($ticket, $status)
    {
        $this->ticket = $ticket;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your ticket for ' . Carbon::parse($this->ticket->date)->format('d M Y') . ' has been ' . strtolower($this->status),
            'ticket_id' => $this->ticket->id,
            'status' => $this->status,
            'date' => $this->ticket->date, // Keep as raw date
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'Your ticket for ' . Carbon::parse($this->ticket->date)->format('d M Y') . ' has been ' . strtolower($this->status),
            'ticket_id' => $this->ticket->id,
            'status' => $this->status,
            'date' => $this->ticket->date, // Keep as raw date
        ]);
    }
}
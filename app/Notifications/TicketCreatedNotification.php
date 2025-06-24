<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
{
    use Queueable;

    public $ticket;
    public $user;

    public function __construct($ticket, $user)
    {
        $this->ticket = $ticket;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'New ticket created by ' . $this->user->name,
            'ticket_id' => $this->ticket->id,
            'date' => $this->ticket->date,
            'user_id' => $this->user->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'New ticket created by ' . $this->user->name,
            'ticket_id' => $this->ticket->id,
            'date' => $this->ticket->date,
            'user_id' => $this->user->id,
        ]);
    }
}


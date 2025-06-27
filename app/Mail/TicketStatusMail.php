<?php
namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $status;

    public function __construct(Ticket $ticket, $status)
    {
        $this->ticket = $ticket;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject("Your Ticket has been {$this->status}")
                    ->markdown('emails.ticket_status');
                    
    }
}

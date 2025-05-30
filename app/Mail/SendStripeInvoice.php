<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendStripeInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $hostedUrl;
    public $invoicePdf;

    public function __construct($hostedUrl, $invoicePdf)
    {
        $this->hostedUrl = $hostedUrl;
        $this->invoicePdf = $invoicePdf;
    }

    public function build()
    {
        return $this->subject('Your Invoice from Our Company')
                    ->view('emails.send_stripe_invoice');
    }
}


@component('mail::message')
<table width="100%" cellpadding="0" cellspacing="0" style="text-align: center;">
    <tr>
        <td>
            <img src="{{ asset('assets/images/logo.png') }}" alt="Company Logo" style="max-height: 80px; margin-bottom: 20px;">
        </td>
    </tr>
    <tr>
        <td>
            <h1 style="color: #d32f2f; font-size: 28px; font-weight: bold; margin-bottom: 10px;">
                New Ticket Submitted
            </h1>
            <p style="color: #555; font-size: 16px;">
                Reason: {{ $ticket->reason }}
            </p>
            <p style="color: #555; font-size: 16px;">
                A new ticket has been submitted by <strong>{{ $user->name }}</strong>.
            </p>
            <table align="center" cellpadding="5" cellspacing="0" width="80%" style="margin: 20px auto; border: 1px solid #eee; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #eee;"><strong>Ticket Date:</strong></td>
                    <td style="border: 1px solid #eee;">{{ \Carbon\Carbon::parse($ticket->date)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #eee;"><strong>Reason:</strong></td>
                    <td style="border: 1px solid #eee;">{{ $ticket->reason }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            @component('mail::button', ['url' => route('ticket.list') . '#ticket-' . $ticket->id])
                View Ticket
            @endcomponent
        </td>
    </tr>
</table>

Thanks,<br>
<strong style="color: #d32f2f;">{{ config('app.name') }}</strong>
@endcomponent

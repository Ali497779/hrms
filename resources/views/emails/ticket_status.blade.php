@component('mail::message')
# Ticket {{ $status }}

Hello {{ $ticket->user->name }},

Your ticket dated **{{ $ticket->date }}** has been **{{ $status }}**.

@component('mail::panel')
**Reason:** {{ $ticket->reason ?? 'N/A' }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
@component('mail::message')
# Welcome to Our Team!

Hello {{ $user->name }},

You've been added as an employee to our system. Please verify your email address by clicking the button below.

@component('mail::button', ['url' => route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)])])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
@component('mail::message')
<table width="100%" cellpadding="0" cellspacing="0" style="text-align: center;">
    <tr>
        <td>
            <img src="{{ asset('assets/images/logo.png') }}" alt="Company Logo" style="max-height: 80px; margin-bottom: 20px;">
        </td>
    </tr>
    <tr>
        <td>
            <h1 style="color: #d32f2f; font-size: 32px; font-weight: bold; margin-bottom: 10px;">
                Welcome to Our Team!
            </h1>
            <p style="color: #555; font-size: 16px;">
                Hello {{ $user->name }},
            </p>
            <p style="color: #555; font-size: 16px;">
                You've been added as an employee to our system.
            </p>
        </td>
    </tr>
</table>

{{-- Optional button if needed in the future --}}
{{-- 
@component('mail::button', ['url' => route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)])])
Verify Email
@endcomponent 
--}}

Thanks,<br>
<strong style="color: #d32f2f;">{{ config('app.name') }}</strong>
@endcomponent
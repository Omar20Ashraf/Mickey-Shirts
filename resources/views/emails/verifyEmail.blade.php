
@component('mail::message')

Hello,
You are receiving this email to Verify Your E-mail 



@component('mail::button', ['url' => '#'])

<a href="{{route('sendingEmail',["email" => $user->email,
								"verifyToken" => $user->verifyToken])}}"> 

Verify E-mail
@endcomponent

{{-- @component('mail::panel')
This is the panel content.
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

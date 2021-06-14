@component('mail::message')
# Account Registered

You can now login with your credentials. See you!

@component('mail::button', ['url' => 'http://127.0.0.1:8000/home'])
Start
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

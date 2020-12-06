@component('mail::message')
# Welcome {{$user->name}}!

> Tnks for use our app.

This is your pass: {{$user->new_pass}}

Thanks, {{ config('app.name') }}
@endcomponent

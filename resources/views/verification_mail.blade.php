<img src="{{asset('logo.jpg')}}" alt="">
@component('mail::message')
# Validation de votre compte

##cher {{$notifiable->name}}

Veuillez cliquez sur le boutton suivant pour valider votre compte.

@component('mail::button', ['url' => $url])
valider mon compte
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent

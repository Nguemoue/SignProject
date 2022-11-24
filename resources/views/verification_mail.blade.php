<img src="{{asset('logo.jpg')}}" alt="">
@component('mail::message')
# Validation de votre compte

## cher {{$notifiable->name}}

Veuillez cliquez sur le boutton suivant pour valider votre compte.

<p>Nous vous remercions pour l'interet que vous portez envers nous.<br>ce message vous est envoyer pour la validation de votre compte apres 
<br>votre inscription sur notre plateforme
</p>
@component('mail::button', ['url' => $url])
valider mon compte
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent

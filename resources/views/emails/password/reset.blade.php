@component('mail::message')
# Processus de réinitialisation du mot de passe

Veuillez utiliser ce code pour réinitialiser votre mot de passe

<h2 style="text-align: center;">{{ $code }}</h2>

Merci,<br>
{{ config('app.name') }}
@endcomponent

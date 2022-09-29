@component('mail::message')

Votre code de vérification est : {{ $code }}

{{ config('app.name') }}
@endcomponent

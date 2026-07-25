@component('mail::message')
# Bienvenue dans l'équipe !

Bonjour **{{ $admin->name }}**,

Un compte d'administration vous a été créé sur la plateforme **405 Group Auto**.

Voici vos identifiants d'accès :
- **Email :** {{ $admin->email }}
- **Mot de passe temporaire :** `{{ $password }}`

@component('mail::button', ['url' => route('login')])
Se connecter à l'administration
@endcomponent

> **Sécurité :** Nous vous recommandons vivement de modifier votre mot de passe dès votre première connexion.

Cordialement,<br>
L'équipe **{{ config('app.name') }}**
@endcomponent
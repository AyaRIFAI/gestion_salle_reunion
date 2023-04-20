@extends('layout')
@section('title', 'Vérification de l\'email')
@section('content')
@if(session()->has('message'))
    <p>
        {{ session()->get('message') }}
    </p>
@endif
<p>
Merci d'avoir inscris!Avant de commencer, Merci de confirmer votre adresse e-mail en cliquant sur le lien qu'on vient de vous envoyer
Si vous n'avez rien reçu, on est très heureux de vous renvoyer le lien.
</p>
<p><form method="post" action="{{route('verification.send')}}">
    @csrf
<input type="submit" value="renvoyer le lien?">
</form> </p>
@endsection
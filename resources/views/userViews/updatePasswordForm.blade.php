@extends('layout')
@section('title', 'Modifier le mot de passe')
@section('content')
<form method="post" action="{{route('updatePassword', ['id'=>$id])}}">
        @csrf
        @error('previous-password')
        {{$message}}
        @enderror
        <p><input type="password" name="previous-password" placeholder="Votre ancien mot de passe"></p>
        @error('password')
        {{$message}}
        @enderror
        <p><input type="password" name="password" placeholder="Votre nouveau mot de passe"></p>
        <p><input type="password" name="password_confirmation" placeholder="Confirmation du mot de passe"></p>
        <p><input type="submit" value="Modifier le mot de passe"></p>
    </form>
@endsection
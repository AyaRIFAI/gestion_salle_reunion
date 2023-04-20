@extends('layout')
@section('title')
Les mots de passe initiaux des professeurs
@endsection
@section('content')
<table>
    <tr>
        <th>Nom complet du professeur</th>
        <th>Mot de passe initial</th>
        <th>partager via</th>
    </tr>
    @forelse($profs as $prof)
    <tr>
       
        <td>{{$prof->user->name}}</td>
        <td>{{$prof->user->initial_password}}</td>
        <td>future partage</td>
       
    </tr>
    @empty
    @endforelse
</table>


@endsection
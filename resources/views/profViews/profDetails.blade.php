@extends('layout')
@section('title')
Informations détaillées
@endsection
@section('content')
<img src="{{Storage::url($prof->path_image)}}" alt="photo de profil du professeur">
<h2>{{$prof->lastName}} {{$prof->firstName}}</h2>
<p>Adresse e-mail: {{$prof->email}}</p>
<p>Numéro de téléphone: {{$prof->Tel}}</p>
<p>Département: {{$prof->departement->name}}</p>
<hr>
<a href="{{route('updateProf1', ['id'=>$prof->id])}}">Modifier les Informations du professeur</a>
@endsection
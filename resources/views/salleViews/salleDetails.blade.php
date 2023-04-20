@extends('layout')
@section('title')
Informations détaillées
@endsection
@section('content')
<img src="{{Storage::url($salle->path_image)}}" alt="Photo de la salle">
<h2>{{$salle->name}}</h2>
<p>{{$salle->description}}</p>
<p>La surface de {{$salle->name}} est égale à {{$salle->surface}} m²</p>
<hr>
@if(session('isAdmin'))
<a href="{{route('update1', ['id'=>$salle->id])}}">Modifier les Informations de la salle</a>
@else
@endif
<p><a href="{{url('/reservations/actuals/salle/'.$salle->id)}}">Liste des réservations actuels de cette salle</a></p>
<p><a href="{{url('/reservations/historic/salle/'.$salle->id)}}">Historique des réservations de cette salle</a></p>
@endsection
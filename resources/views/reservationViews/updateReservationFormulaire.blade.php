@extends('layout')
@section('title', 'Modifier une réservation')
@section('content')
<div class="form d-flex flex-column">
    <div class="package bg-white p-5">

<form method="post" action="{{route('demandeUpdateReservation', ['id'=>$reservation->id])}}">
        @csrf
        @error('salle')
        {{$message}}
        @enderror
        <div class="mb-3">
            <input type="txt" name="salle" id="salle" placeholder="nom de la salle" class="form-control" value="{{$reservation->salle->name}}">
        </div>
        @error('motif')
        {{$message}}
        @enderror
        <div class="mb-3 d-flex">
            <label class="choose input-group-text" for="inputGroupSelect01">Objectif</label>
            <select name="motif" class="form-select" id="inputGroupSelect01">
                <option value="réunion conseil d’établissement" {{$reservation->motif ==='réunion conseil d’établissement'?'selected':''}}> réunion conseil d’établissement</option>
                <option value="réunion commission pédagogique" {{ $reservation->motif ==='réunion commission pédagogique'?'selected':''}}>réunion commission pédagogique</option>
                <option value="réunion commission de recherche scientifique" {{ $reservation->motif ==='réunion commission de recherche scientifique'?'selected':''}}>réunion commission de recherche scientifique</option>
                <option value="réunion commission culturelle" {{ $reservation->motif ==='réunion commission culturelle'?'selected':''}}>réunion commission culturelle</option>
                <option value="réunion filière" {{ $reservation->motif ==='réunion filière'?'selected':''}}>réunion filière</option>
                <option value="réunion AG département" {{ $reservation->motif ==='réunion AG département'?'selected':''}}>réunion AG département</option>
                <option value="réunion syndicat" {{ $reservation->motif ==='réunion syndicat'?'selected':''}}> réunion syndicat</option>
                <option value="réunion délibérations" {{ $reservation->motif ===' réunion délibérations'?'selected':''}}> réunion délibérations</option>
            </select>
        </div>
        @error('reunion_date')
        {{$message}}
        @enderror
        <div class="mb-3">
            <label for="reunion_date" class="form-label" >La date de la réunion</label>
        
            <input type="date" id="reunion_date" name="reunion_date" value="{{$reservation->reunion->reunion_date}}" class="form-control">
        </div>
        @error('beginning_hour')
        {{$message}}
        @enderror
        <div class="mb-3">
            <label for="beginning_hour">Heure début</label>
            <input type="time" id="beginning_hour" class="form-control" name="beginning_hour" value="{{ date('H:s', strtotime($reservation->reunion->beginning_hour))}}">
        </div>
        @error('finish_reunion_hour')
        {{$message}}
        @enderror
        <div class="mb-5">
            <label for="finish_reunion_hour" class="form-label">Heure prévue de fin de la réunion</label>
            <input type="time" id="finish_reunion_hour" name="finish_reunion_hour" value="{{date('H:s', strtotime($reservation->reunion->finish_reunion_hour))}}" class="form-control">
        </div>
        <div class="d-flex justify-content-evenly">   
            <input type="submit" value="Modifier la demande" class="text-center">
            <a class="lien p-2 bg-white" href="{{url('/')}}">Annuler</a>
        </div>
    </form>
@endsection
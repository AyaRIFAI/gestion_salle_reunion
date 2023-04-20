@extends('layout')
@section('title', 'Demander une réservation')
@section('content')
<div class="form d-flex flex-column">
    <div class="package bg-white p-5">
    <div class="p-3  mb-3 p-sm-2 mb-sm-2">
        <p class="theme fs-2 m-0 p-1 text-center text-capitalize">Ajouter une reservation</p>
    </div>
<form method="post" action="{{url('/reservations/add')}}">
        @csrf
        @error('salle')
        {{$message}}
        @enderror
        <div class="mb-3">
            <input type="txt" name="salle" id="salle" placeholder="nom de la salle" class="form-control">
        </div>
        @error('motif')
        {{$message}}
        @enderror
        <div class="mb-3 d-flex">
            <label class="choose input-group-text" for="inputGroupSelect01">Objectif</label>
            <select name="motif" class="form-select" id="inputGroupSelect01">
                <option value="réunion conseil d’établissement"> réunion conseil d’établissement</option>
                <option value="réunion commission pédagogique">réunion commission pédagogique</option>
                <option value="réunion commission de recherche scientifique">réunion commission de recherche scientifique</option>
                <option value="réunion commission culturelle">réunion commission culturelle</option>
                <option value="réunion filière">réunion filière</option>
                <option value="réunion AG département">réunion AG département</option>
                <option value=" réunion syndicat"> réunion syndicat</option>
                <option value=" réunion délibérations"> réunion délibérations</option>
            </select>
        </div>
        @error('reunion_date')
        {{$message}}
        @enderror
        <div class="mb-3">
            <label for="reunion_date" class="form-label">La date de la réunion</label>
            <input type="date" id="reunion_date" name="reunion_date" class="form-control">
        </div>
        @error('beginning_hour')
        {{$message}}
        @enderror
        <div class="mb-3">
            <label for="beginning_hour" class="form-label">Heure début</label>
            <input type="time" id="beginning_hour" name="beginning_hour" class="form-control">
        </div>
        @error('finish_reunion_hour')
        {{$message}}
        @enderror
        <div class="mb-5">
            <label for="finish_reunion_hour" class="form-label">Heure prévue de fin de la réunion</label>
            <input type="time" id="finish_reunion_hour" name="finish_reunion_hour" class="form-control">
        </div>
        <div class="d-flex justify-content-evenly">
            @if(session('isAdmin'))
            <input type="submit" value="Ajouter une réservation" class="p-2">
            @else
            <input type="submit" value="Demander une réservation" class="p-2">
            @endif
            <a class="lien p-2 bg-white" href="{{url('/')}}">Annuler</a>
        </div>
    </form>
    </div>
</div>
@endsection
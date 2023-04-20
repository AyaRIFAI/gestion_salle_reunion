@extends('layout')
@section('title', 'Supprimer une salle')
@section('content')
<div class="form d-flex flex-column pt-md-5 pt-sm-5">
    <div class="package bg-white p-5">
    <div class="p-3  mb-3 p-sm-2 mb-sm-2">
        <p class="theme fs-2 m-0 p-1 text-center text-capitalize">Supprimer une salle</p>
    </div>
<form method="post" action="{{url('/salles/delete')}}">
        @csrf
        @error('name')
        {{$message}}
        @enderror
        <div class="mb-4">
        <input type="txt" name="name" placeholder="Intitulé de la salle" class="form-control">
        </div>
       
        <input type="submit" value="Supprimer La Salle" class="p-2">
    </form>
    </div>
</div>
@endsection
@extends('layout')
@section('title', 'Ajouter un departement')
@section('content')
<div class="form d-flex flex-column pt-md-5 pt-sm-5">
    <div class="package bg-white p-5">
    <div class="p-3  mb-3 p-sm-2 mb-sm-2">
        <p class="theme fs-2 m-0 p-1 text-center text-capitalize">Modifier un département</p>
    </div>
<form method="post" action="{{route('update', ['id'=>$departement->id])}}">
        @csrf
        @error('name')
        {{$message}}
        @enderror
        <div class="mb-4">
            <input type="txt" name="name" placeholder="intitulé du département" value="{{ $departement->name}}">
        </div>
        @error('path_image')
        {{$message}}
        @enderror
        <div class="mb-4">
            <input type="txt" name="sigle" placeholder="Sigle(abréviation du nom)" class="p-1 form-control" value="{{ $departement->sigle}}">
        </div>
        @error('description')
        {{$message}}
        @enderror
 
        <div class="d-flex justify-content-evenly">
            <input type="submit" value="Modifier un département">
            <a class="lien p-2 bg-white" href="{{url('departements')}}">Annuler</a>
        </div>
    </form>
@endsection
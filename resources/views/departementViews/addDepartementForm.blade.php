@extends('layout')
@section('title', 'Ajouter un departement')
@section('content')
<div class="form d-flex flex-column pt-md-5 pt-sm-5">
    <div class="package bg-white p-5">
    <div class="p-3  mb-3 p-sm-2 mb-sm-2">
        <p class="theme fs-2 m-0 p-1 text-center text-capitalize">Ajouter un département</p>
    </div>
<form method="post" action="{{url('/departements/add')}}">
        @csrf
        @error('name')
        {{$message}}
        @enderror
        <div class="mb-4">
            <input type="txt" name="name" placeholder="Intitulé du département" class="p-1 form-cotrol">
        </div>
        @error('sigle')
        {{$message}}
        @enderror
        <div class="mb-4">
            <input type="txt" name="sigle" placeholder="Sigle(abréviation du nom)" class="p-1 form-control">
        </div>
        @error('path_image')
        {{$message}}
        @enderror
        <div class="d-flex justify-content-evenly">
            <input type="submit" value="Ajouter un departement" class="p-2">
            <a class="lien p-2 bg-white" href="{{url('profs')}}">Annuler</a>
        </div>
    </form>
    </div>
</div>
@endsection
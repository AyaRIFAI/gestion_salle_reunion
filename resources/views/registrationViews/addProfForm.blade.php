@extends('layout')
@section('title', 'Ajouter un professeur')
@section('content')
<div class="form d-flex flex-column pt-md-5 pt-sm-5">
    <div class="package bg-white p-5">
    <div class="p-3  mb-3 p-sm-2 mb-sm-2">
        <p class="theme fs-2 m-0 p-1 text-center text-capitalize">Ajouter un professeur</p>
    </div>
<form method="post" action="{{url('/profs/add')}}" enctype="multipart/form-data">
        @csrf
        @error('path_image')
        {{$message}}
        @enderror
        <div class="input-group mb-4">
            <label id="label1" for="inputGroupFile"class="me-3 pe-2 ps-2 form-label">Photo du professeur</label>
            <input type="file" name="path_image" class="form-control" id="inputGroupFile"accept="image/png, image/jpeg">
        </div>
        @error('lastName')
        {{$message}}
        @enderror
        <div class="mb-4">
        <input type="txt" name="lastName" placeholder="Nom du professeur" class="form-control">
        </div>
        @error('firstName')
        {{$message}}
        @enderror
        <div class="mb-4">
        <input type="txt" name="firstName" placeholder="Prénom du professeur" class="form-control">
        </div>
        @error('Tel')
        {{$message}}
        @enderror
        <div class="mb-4">
        <input type="txt" name="Tel" placeholder="N° Tél" class="form-control">
        </div>
        @error('email')
        {{$message}}
        @enderror
        <div class="mb-4">
        <input type="email" name="email" placeholder="Adresse e-mail" class="form-control">
        </div>
        @error('departement_id')
        {{$message}}
        @enderror
        <div class="mb-3 d-flex">
            <label class="choose input-group-text" for="inputGroupSelect01">Département</label>
        
        <select name="departement_id" class="form-select" id="inputGroupSelect01">
            @foreach($departements as $departement)
            <option value="{{$departement->id}}"> {{$departement->name}}</option>
            @endforeach
        </select>
        </div>
        <div class="d-flex justify-content-evenly">
         <input type="submit" value="Ajouter un professeur" class="p-2">
         <a class="lien p-2 bg-white" href="{{url('profs')}}">Annuler</a>
        </div>
    </form>
    </div>
</div>
@endsection
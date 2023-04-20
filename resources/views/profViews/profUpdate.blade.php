@extends('layout')
@section('content')
<div class="form d-flex flex-column pt-md-5 pt-sm-5">
    <div class="package bg-white p-5">
    <div class="p-3  mb-3 p-sm-2 mb-sm-2">
        <p class="theme fs-2 m-0 p-1 text-center text-capitalize">Modifier un professeur</p>
    </div>
<form method="post" action="{{route('updateProf2', ['id'=>$prof->id])}}" enctype="multipart/form-data">
        @csrf
        @csrf
        @error('path_image')
        {{$message}}
        @enderror
        <div class="input-group mb-4">
        <label id="label1" for="inputGroupFile"class="me-3 pe-2 ps-2 form-label">Photo du professeur</label>
        <input type="file" name="path_image" class="form-control" id="inputGroupFile" accept="image/png, image/jpeg">
        </div>
        @error('lastName')
        {{$message}}
        @enderror
        <div class="mb-4">
            <input type="txt" name="lastName" class="form-control" placeholder="Nom du professeur" value="{{$prof->lastName}}">
        </div>
        @error('firstName')
        {{$message}}
        @enderror
        <div class="mb-4">
        <input type="txt" name="firstName" class="form-control" placeholder="Prénom du professeur" value="{{$prof->firstName}}">
        </div>
        @error('Tel')
        {{$message}}
        @enderror
        <div class="mb-4">
            <input type="txt" name="Tel" class="form-control" placeholder="N° Tél" value="{{$prof->Tel}}">
        </div>
        @error('email')
        {{$message}}
        @enderror
        <div class="mb-4">
            <input type="email" name="email" class="form-control" placeholder="adresse e-mail" value="{{$prof->email}}">
        </div>
        @error('departement_id')
        {{$message}}
        @enderror
        <div class="mb-3 d-flex">
            <label class="choose input-group-text" for="inputGroupSelect01">Département</label>
        <select name="departement_id" class="form-select" id="inputGroupSelect01">
            @foreach($departements as $departement)
            <option value="{{$departement->id}}" {{$departement->id === $prof->departement_id?'selected':'' }} > {{$departement->name}}</option>
            @endforeach
        </select>
        </div>
        <div class="d-flex justify-content-start">
         <input type="submit" value="Modifier un professeur" class="p-2 me-3">
         <a class="lien p-2 bg-white" href="{{url('profs')}}">Annuler</a>
        </div>
    </form>
    </div>
</div>

@endsection
@extends('layout')
@section('content')
<div class="form d-flex flex-column pt-md-5 pt-sm-5">
    <div class="package bg-white p-5">
    <div class="p-3  mb-3 p-sm-2 mb-sm-2">
        <p class="theme fs-2 m-0 p-1 text-center text-capitalize">Modifier une salle</p>
    </div>
<form method="post" action="{{route('updateStore', ['id'=>$salle->id])}}" enctype="multipart/form-data" >
        @csrf
        @error('name')
        {{$message}}
        @enderror
        <div class="mb-4">
            <input type="txt" name="name" placeholder="intitulé de la salle" value="{{$salle->name}}">
        </div>
        @error('path_image')
        {{$message}}
        @enderror
        <div class="input-group mb-4">
        <label id="label1" for="inputGroupFile"class="me-3 pe-2 ps-2">Image de la salle</label>
        <input type="file" name="path_image" class="form-control" id="inputGroupFile" accept="image/png, image/jpeg" value="{{$salle->path_image}}">
        </div>
        @error('surface')
        {{$message}}
        @enderror
        <div class="mb-4">
            <input type="number" name="surface" placeholder="surface de la salle" step="0.01" min="0" value="{{$salle->surface}}">m²
        </div>
        @error('description')
        {{$message}}
        @enderror
        <div class="mb-4">
            <textarea name="description" placeholder="description de la salle">{{$salle->description}}</textarea>
        </div>
        <div class="d-flex justify-content-evenly">
            <input type="submit" value="Modifier la salle">
            <a class="lien p-2 bg-white" href="{{url('salles')}}">Annuler</a>
        </div>
    </form>
    </div>
</div>
@endsection
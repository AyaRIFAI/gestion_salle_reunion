@extends('layout')
@section('title')
Informations sur {{ $departement->sigle}}
@endsection
@section('content')
<h2>{{$departement->name}}</h2>
<table>
@forelse($departement->profs as $prof)
<tr>
<td>{{$prof->lastName}} {{$prof->firstName}}</td>
<td>{{$prof->email}}</td>
</tr>
@empty
<tr>
    <td>Aucun prof n'appartient à ce département</td>
</tr>
@endforelse
</table>
<hr>
<a href="{{route('departementUpdate',['id'=>$departement->id])}}">Modifier les Informations du département</a>
@endsection
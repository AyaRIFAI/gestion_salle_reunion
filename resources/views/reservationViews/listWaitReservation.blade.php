@extends('layout')

@if(session('isAdmin') == 1)
@section('content')
<div class="listeR d-flex justify-content-start align-items-center flex-column pt-5">
    <article class="premierTab table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">Salle</th>
                <th scope="col">Professeur demandant</th>
                <th scope="col">motif</th>
                <th scope="col">date de la réunion</th>
                <th scope="col">Heure début</th>
                <th scope="col">Heure prévue de fin</th>
                <th scope="col">Date de dernière modification</th>
                <th scope="col" class="colonneLien"></th>
                <th scope="col" class="colonneLien"></th>
            </tr>
    </thead>
    <tbody>
    @forelse($reservations as $reservation)
    <tr>
        <td>{{$reservation->salle->name}}</td>
        <td>{{$reservation->prof->lastName}} {{$reservation->prof->firstName}}</td>
        <td>{{$reservation->motif}}</td>
        <td>{{$reservation->reunion->reunion_date}}</td>
        <td>{{$reservation->reunion->beginning_hour}}</td>
        <td>{{$reservation->reunion->finish_reunion_hour}}</td>
        <td>{{$reservation->updated_at}}</td>
        <td class="colonneLien"><a href="{{url('/reservations/accept/'.$reservation->id)}}" class="lien btn btn-primary">Accepter</a></td>
        <td class="colonneLien"><a href="{{url('/reservations/refuse/'.$reservation->id)}}" class="lien btn btn-primary">Refuser</a></td></td>
    </tr>

    @empty
    @endforelse
    </tbody>
</table>
@endsection
@else
@section('content')

<div class="listeR d-flex justify-content-start align-items-center flex-column pt-5">
    <article class="premierTab">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Salle</th>
                    <th scope="col">motif</th>
                    <th scope="col">date de la réunion</th>
                    <th scope="col">Heure début</th>
                    <th scope="col">Heure prévue de fin</th>
                    <th scope="col">Date de dernière modification</th>
                    <th scope="col" class="colonneLien"></th>
                </tr>
    @forelse($reservations as $reservation)

    @if($reservation->prof_id == session('prof_id'))
    <tr>
        <td>{{$reservation->salle->name}}</td>
        <td>{{$reservation->motif}}</td>
        <td>{{$reservation->reunion->reunion_date}}</td>
        <td>{{$reservation->reunion->beginning_hour}}</td>
        <td>{{$reservation->reunion->finish_reunion_hour}}</td>
        <td>{{$reservation->updated_at}}</td>
        <td class="colonneLien"><a href="{{url('/reservations/delete/'.$reservation->id)}}"  class="lien btn btn-primary">Annuler</a></td></td>
    </tr>
    @endif
    @empty
    @endforelse
</table>
@endsection
@endif


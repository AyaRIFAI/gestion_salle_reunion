@extends('layout')
@section('content')
@if(session('isAdmin'))
<div class="listeR d-flex justify-content-start align-items-center flex-column pt-5">
    <article class="premierTab table-responsive">
    <h3 class="text-center mb-3">Les demandes de réservations refusées</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Salle</th>
                    <th scope="col">Professeur demandant</th>
                    <th scope="col">motif</th>
                    <th scope="col">date de la réunion</th>
                    <th scope="col">Heure début</th>
                    <th scope="col">Heure prévue de fin</th>
                    <th scope="col">Dernière date de modification</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr class="align-middle">
                    <td>{{$reservation->salle->name}}</td>
                    <td>{{$reservation->prof->lastName}} {{$reservation->prof->firstName}}</td>
                    <td>{{$reservation->motif}}</td>
                    <td>{{$reservation->reunion->reunion_date}}</td>
                    <td>{{$reservation->reunion->beginning_hour}}</td>
                    <td>{{$reservation->reunion->finish_reunion_hour}}</td>
                    <td>{{ $reservation->updated_at }}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </article>
@else

<div class="listeR d-flex justify-content-start align-items-center flex-column pt-5">
    <article class="premierTab table-responsive">
    <h3 class="text-center mb-3">Vos demandes de réservations refusées</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Salle</th>
                    <th>motif</th>
                    <th>date de la réunion</th>
                    <th>Heure début</th>
                    <th>Heure prévue de fin</th>
                    <th>Dernière date de modification</th>
                </tr>
            </thead>
            <tbody>
            @forelse($reservations as $reservation)
                @if($reservation->prof_id == session('prof_id'))
                    <tr>
                        <td>{{$reservation->salle->name}}</td>
                        <td>{{$reservation->motif}}</td>
                        <td>{{$reservation->reunion->reunion_date}}</td>
                        <td>{{$reservation->reunion->beginning_hour}}</td>
                        <td>{{$reservation->reunion->finish_reunion_hour}}</td>
                        <td rowspan="2">{{$reservation->updated_at}}</td>
                    </tr>
                @endif
            @empty
            @endforelse
        </table>
    </article>
@endif
@endsection
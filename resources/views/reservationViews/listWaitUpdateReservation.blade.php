@extends('layout')
@section('content')
<div class="listeR d-flex justify-content-start align-items-center flex-column pt-5">
@forelse($newReservations as $newReservation)
@forelse($origins as $origin)
@if((-1-$newReservation->state) == $origin->id)
@if(session('isAdmin'))
    <article class="premierTab w-80 mb-3">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Salle</th>
                    <th scope="col">Professeur demandant</th>
                    <th scope="col">motif</th>
                    <th scope="col">date de la réunion</th>
                    <th scope="col">Heure début</th>
                    <th scope="col">Heure prévue de fin</th>
                    <th scope="col">Dernière date de modification</th>
                    <th scope="col" class="colonneLien"></th>
                    <th scope="col" class="colonneLien"></th>
                </tr>
            </thead>
                <tbody>
                    <tr>
                    <th  scope="row">Demande à modifier</th>
                        <td>{{$origin->salle->name}}</td>
                        <td>{{$origin->prof->lastName}} {{$origin->prof->firstName}}</td>
                        <td>{{$origin->motif}}</td>
                        <td>{{$origin->reunion->reunion_date}}</td>
                        <td>{{$origin->reunion->beginning_hour}}</td>
                        <td>{{$origin->reunion->finish_reunion_hour}}</td>
                        <td rowspan="2">{{$newReservation->updated_at}}</td>
                        <td rowspan="2" class="colonneLien"><a href="{{url('/reservations/update/accept/'.$newReservation->id)}}" class="lien btn btn-primary">Accepter</a></td>
                        <td rowspan="2" class="colonneLien"><a href="{{url('/reservations/delete/'.$newReservation->id)}}" class="lien btn btn-primary">Refuser</a></td></td>
                    </tr>
    <tr>
       <th  scope="row">Demande modifiée</th>
        <td>{{$newReservation->salle->name}}</td>
        <td>{{$newReservation->prof->lastName}} {{$newReservation->prof->firstName}}</td>
        <td>{{$newReservation->motif}}</td>
        <td>{{$newReservation->reunion->reunion_date}}</td>
        <td>{{$newReservation->reunion->beginning_hour}}</td>
        <td>{{$newReservation->reunion->finish_reunion_hour}}</td>
    </tr>
</table>
 </article>
@else
    <article class="premierTab">
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Salle</th>
                <th scope="col">motif</th>
                <th scope="col">date de la réunion</th>
                <th scope="col">Heure début</th>
                <th scope="col">Heure prévue de fin</th>
                <th scope="col">Dernière date de modification</th>
                <th scope="col" class="colonneLien"></th>
        </tr>
    <tr>
       <th scope="row">Demande à modifier</th>
        <td>{{$origin->salle->name}}</td>
        <td>{{$origin->motif}}</td>
        <td>{{$origin->reunion->reunion_date}}</td>
        <td>{{$origin->reunion->beginning_hour}}</td>
        <td>{{$origin->reunion->finish_reunion_hour}}</td>
        <td rowspan="2">{{$newReservation->updated_at}}</td>
        <td rowspan="2"><a href="{{url('/reservations/delete/'.$newReservation->id)}}" class="lien btn btn-primary">Annuler</a></td></td>
    </tr>
    <tr>
       <th  scope="row">Demande modifiée</th>
        <td>{{$newReservation->salle->name}}</td>
        <td>{{$newReservation->motif}}</td>
        <td>{{$newReservation->reunion->reunion_date}}</td>
        <td>{{$newReservation->reunion->beginning_hour}}</td>
        <td>{{$newReservation->reunion->finish_reunion_hour}}</td>
    </tr>
</table>
    </article>
@endif
@endif
@empty

@endforelse
@empty
<div class="only d-flex justify-content-center align-items-center">
<p class="noOne text-center p-5">Il n y'a aucune demande de modification des réservations à ce moment au cours du traitement</p>
</div>
@endforelse
</div>
@endsection
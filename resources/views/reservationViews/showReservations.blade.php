@extends('layout')

@section('content')
<div class="listeR d-flex justify-content-start align-items-center flex-column">
<article class="premierTab mb-5">
    <h3 class="text-center mb-3">Les réservations prises par les professeurs</h3>
    <table class="table table-striped table-hover">
    <thead>
        <tr>
            @if($i!=1)
            <th scope="col">Salle</th>
            @endif
            <th scope="col">Professeur demandant</th>
            <th scope="col">motif</th>
            <th scope="col">date de la réunion</th>
            <th scope="col">Heure début</th>
            <th scope="col">Heure prévue de fin</th>
            @if($j==1 && session('isAdmin'))
            <th scope="col">Dernière date de modification</th>
            <th scope="col" class="colonneLien"></th>
            <th scope="col" class="colonneLien"></th>
            <th scope="col" class="colonneLien"></th>
            @endif
        </tr>
        <tbody>
        @forelse($all as $one)
        <tr>
            @if($i!=1)
                <td>{{$one->name}}</td>
            @endif
            <td>{{$one->lastName}} {{$one->firstName}}</td>
            <td>{{$one->motif}}</td>
            <td>{{$one->reunion_date}}</td>
            <td>{{$one->beginning_hour}}</td>
            <td>{{$one->finish_reunion_hour}}</td>
            @if($j==1 && session('isAdmin'))
                <td>{{$one->updated_at}}</td>
                <td><a href="{{url('/reservations/accept/'.$one->id)}}" class="lien btn btn-primary">Accepter</a></td>
                <td><a href="{{url('/reservations/waiting/'.$one->id)}}" class="lien btn btn-primary">Mettre en attente</a></td> 
                <td class="colonneLien"><a href="{{url('/reservations/delete/'.$one->id)}}" class="lien btn btn-primary">Refuser</a></td>    
            @endif
        </tr>
        @empty
        @endforelse
        </tbody>
    </table>
</article>
<article class="deuxiemeTab">
    @if($all2!=null)
    <h3 class="text-center mb-3">Les réservations prises par l'administrateur</h3>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                @if($i!=1)
                <th scope="col">Salle</th>
                @endif
                <th scope="col">motif</th>
                <th scope="col">date de la réunion</th>
                <th scope="col">Heure début</th>
                <th scope="col">Heure prévue de fin</th>
                @if(session('isAdmin') && !str_contains($title, 'Historique'))
                <th scope="col" class="colonneLien"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($all2 as $one2)
            <tr>
                @if($i!=1)
                <td>{{$one2->name}}</td>
                @endif
                <td>{{$one2->motif}}</td>
                <td>{{$one2->reunion_date}}</td>
                <td>{{$one2->beginning_hour}}</td>
                <td>{{$one2->finish_reunion_hour}}</td>
                @if(session('isAdmin') && !str_contains($title, 'Historique'))
                <td class="colonneLien"><a href="{{url('/reservations/delete/'.$one2->id)}}" class="lien btn btn-primary">Annuler</a></td>
                @endif
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</article>
@endif
@if($nameRoute!=null)
<p><a href="{{route($nameRoute)}}" class="lien btn btn-primary">Imprimer</a></p>
@endif
</div>
@endsection
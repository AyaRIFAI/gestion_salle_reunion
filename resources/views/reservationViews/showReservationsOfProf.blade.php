@extends('layout')

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
                    <th scope="col">Dernière date de modification</th>
        
                    <th scope="col" class="colonneLien"></th>
                    <th scope="col" class="colonneLien"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($all as $one)
                <tr>
                    <td>{{$one->name}}</td> 
                    <td>{{$one->motif}}</td>
                    <td>{{$one->reunion_date}}</td>
                    <td>{{$one->beginning_hour}}</td>
                    <td>{{$one->finish_reunion_hour}}</td>
                    <td>{{$one->updated_at}}</td>
                    @if($i==0)
                    <td class="colonneLien"><a href="{{url('/reservations/update/'.$one->id)}}" class="lien btn btn-primary">Modifier directement</a></td>
                    @elseif($i==1)
                    <td class="colonneLien"><a href="{{url('/reservations/update/'.$one->id)}}" class="lien btn btn-primary">Envoyer une demande de modification</a></td>
                    @endif
                    <td class="colonneLien"><a href="{{url('/reservations/delete/'.$one->id)}}" class="lien btn btn-primary">Annuler</a></td> 
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </article>
</div>
@endsection
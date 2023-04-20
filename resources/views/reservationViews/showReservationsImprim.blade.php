<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion_Salles_Reunion</title>
</head>
<body>
    <h1>{{$title}}</h1>
    <h3>Les réservations prises par les professeurs</h3>
    <table>
    <tr>
        @if($i!=1)
        <th>Salle</th>
        @endif
        <th>Professeur demandant</th>
        <th>motif</th>
        <th>date de la réunion</th>
        <th>Heure début</th>
        <th>Heure prévue de fin</th>
        @if($j==1)
        <th>Dernière date de modification</th>
        @endif

    </tr>
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
        @if($j==1)
        <td>{{$one->updated_at}}</td>
        
        @endif
    </tr>
    @empty
    @endforelse
</table>
<h3>Les réservations prises par l'administrateur</h3>
<table>
    <tr>
        @if($i!=1)
        <th>Salle</th>
        @endif
        <th>motif</th>
        <th>date de la réunion</th>
        <th>Heure début</th>
        <th>Heure prévue de fin</th>
    </tr>
    @forelse($all2 as $one2)
    <tr>
        @if($i!=1)
        <td>{{$one2->name}}</td>
        @endif
        <td>{{$one2->motif}}</td>
        <td>{{$one2->reunion_date}}</td>
        <td>{{$one2->beginning_hour}}</td>
        <td>{{$one2->finish_reunion_hour}}</td>
    </tr>
    @empty
    @endforelse
</table>
</body>
</html>

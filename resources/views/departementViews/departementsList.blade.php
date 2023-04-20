@extends('layout')
@section('content')
<article class="article row">
    <main class="details h-lg-100 h-md-70 h-sm-30 col-lg-9 col-md-12 col-sm-12 d-flex justify-content-center align-items-center flex-column mt-0 order-md-2 order-sm-2 order-xs-2 order-xxs-2">
    <div class="liens mb-3 h-md-50 d-flex justify-content-around align-items-center">
        <a href="{{url('/departements/add')}}" title="Ajouter un departement" class="lien btn btn-primary me-3">Ajouter un departement</a>
        <a href="{{url('/departements/delete')}}" title="Supprimer un departement" class="lien btn btn-primary me-3">Supprimer un departement</a>
    </div>
    <div class="h-md-50 d-flex justify-content-center align-items-center">
        <!-- <div class="boite d-flex justify-content-center align-items-center"> -->
        <div class="boite row">
            <div class="col order-lg-first order-md-first order-sm-last order-xxs-last">
                <div class="package p-5 w-100">
                <article class="table-sm-responsive d-flex flex-column align-items-center justify-content-start">
                    <h3 class="titreH3 text-center mb-3"></h3>
                    <table class="table table-striped table-hover w-fit-content">
                        <thead>
                        <tr>
                            <th scope="col">Professeur</th>
                            <th scope="col">Adresse e-mail</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </article>
                <div class="pt-3">
                  <a class="modifier p-1">Modifier ce département</a>
                </div>
            </div>
        </div>
    </main>
    <aside class="col-lg-3 col-md-12 col-sm-12 order-md-1 order-sm-1 order-xs-1 order-xxs-1 h-lg-100 h-md-30 h-sm-30 d-flex justify-content-center align-items-center">
        <div class="liste d-flex flex-lg-column flex-md-row flex-sm-row justify-content-center align-items-center g-1">
            <button id="one"></button>
            <button id="two"></button>
        </div>
    </aside>
    <p class="listeDepartements d-none">{{$departements}}</p>
    <p class="resultatsDepartements d-none">{{$resultats}}</p>
    
@endsection
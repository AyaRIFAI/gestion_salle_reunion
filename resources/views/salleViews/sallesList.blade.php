@extends('layout')
@section('content')
<article class="article row">
    <main class="details h-lg-100 h-md-70 h-sm-30 col-lg-9 col-md-12 col-sm-12 d-flex justify-content-center align-items-center flex-column mt-0 order-md-2 order-sm-2 order-xs-2 order-xxs-2">
    <div class="liens mb-3 h-md-50 d-flex justify-content-around align-items-center">
    @if(session('isAdmin'))
        <a href="{{url('/salles/add')}}" title="Ajouter une salle" class="lien btn btn-primary me-3">Ajouter une salle</a>
        <a href="{{url('/salles/delete')}}" title="Supprimer une salle" class="lien btn btn-primary">Supprimer une salle</a>
    @else
        <a href="{{url('/reservations/add')}}" class="lien btn btn-primary">Demander une réservation</a>
    @endif
    </div>
    <div class="h-md-50 d-flex justify-content-center align-items-center">
        <!-- <div class="boite d-flex justify-content-center align-items-center"> -->
        <div class="boite row">
            <div class="infos col-lg-6 col-md-6 col-sm-12 order-lg-first order-md-first order-sm-last order-xxs-last">
                    <div class="package p-5 w-100">
                        <form>
                            <div class="mb-4">
                                <input type="txt" name="name" class="form-control infoInput" readonly>
                            </div>
                            <div class="mb-4">
                                <input type="text" name="surface" class="form-control infoInput" readonly >
                            </div>
                            <div class="mb-4">
                                <textarea name="description" class="form-control infoInput" readonly></textarea>
                            </div>
                            @if(session('isAdmin'))
                            <div class="pt-3">
                              <a class="modifier p-1">Modifier cette salle</a>
                            </div>
                            @endif
                        </form>
                        </div>

            </div>
            <div class="placeOfImg col-lg-6 col-md-6 col-sm-12 order-lg-last order-md-last order-sm-first order-xs-first order-xxs-first d-flex justify-content-center align-items-center"></div> 
</div>
    </main>
    <aside class="col-lg-3 col-md-12 col-sm-12 order-md-1 order-sm-1 order-xs-1 order-xxs-1 h-lg-100 h-md-30 h-sm-30 d-flex justify-content-center align-items-center">
        <div class="liste d-flex flex-lg-column flex-md-row flex-sm-row justify-content-center align-items-center g-1">
            <button id="one"></button>
            <button id="two"></button>
        </div>
    </aside>
    <p class="table2 d-none">{{$salles}}</p>
</article>
@endsection
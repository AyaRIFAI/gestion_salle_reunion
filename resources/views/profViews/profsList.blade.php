@extends('layout')
@section('content')
<article class="article row">
    <main class="details h-lg-100 h-md-70 h-sm-30 col-lg-9 col-md-12 col-sm-12 d-flex justify-content-center align-items-center flex-column mt-0 order-md-2 order-sm-2 order-xs-2 order-xxs-2">
    <div class="liens mb-3 h-md-50 d-flex justify-content-around align-items-center">
        <a href="{{url('/profs/add')}}" title="Ajouter un professeur" class="lien btn btn-primary me-3">Ajouter un professeur</a>
        <a href="{{url('/profs/delete')}}" title="Supprimer un professeur" class="lien btn btn-primary">Supprimer un professeur</a>
    </div>
    <div class="h-md-50 d-flex justify-content-center align-items-center">
        <!-- <div class="boite d-flex justify-content-center align-items-center"> -->
        <div class="boite row">
            <div class="infos col-lg-6 col-md-6 col-sm-12 order-lg-first order-md-first order-sm-last order-xxs-last">
                    <div class="package p-5 w-100">
                        <form>
                            <div class="mb-4">
                                <input type="txt" name="lastName"  readonly class="form-control infoInput">
                            </div>
                            <div class="mb-4">
                                <input type="txt" name="firstName" readonly class="form-control infoInput">
                            </div>

                            <div class="mb-4">
                                <input type="txt" name="Tel" readonly class="form-control infoInput">
                            </div>

                            <div class="mb-4">
                                <input type="email" name="email" class="form-control infoInput" readonly>
                            </div>
                            <div class="mb-3 d-flex flex-lg-row flex-md-row flex-xs-row flex-xxs-column">
                                <label>Département</label>
                                <input type="text" name="departement" readonly class="infoInput text-center">
                            </div>   
                            <div class="pt-3">
                              <a class="modifier p-1">Modifier ce profil</a>
                            </div>
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
    <p class="table2 d-none">{{$profs}}</p>
    <p class="departements d-none">{{$departements}}</p>
</article>
@endsection
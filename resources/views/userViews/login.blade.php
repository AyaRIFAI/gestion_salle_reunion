@extends('layout')
@section('content')
    <div class="loginPage">
            <main class="wholeBox">
                <div class="insideWholeBox d-flex flex-row-reverse ">
                    <div class="rightBox bg-white d-flex flex-column justify-content-center align-items-center">
                            <div class="p-3  mb-3 p-sm-2  mb-sm-2">
                                <p class="bienvenue fs-2 m-0 p-1 text-center">Bienvenue</p>
                                <p class="bienvenue text-black-50 m-0 p-0">Veuillez vous connecter pour continuer</p>
                            </div>
                            @error('failed')
                            {{$message}}
                            @enderror
                            <form method="post" action="{{url('/authenticate')}}" class="d-flex flex-column justify-content-around align-items-center">
                                @csrf
                                @error('email')
                                {{$message}}
                                @enderror
                                <div class="mb-2 mb-sm-0">
                                    <div>
                                        <input type="email" name="email" placeholder="@ Votre adresse e-mail" class="p-1 mb-4 mb-sm-2">
                                    </div>
                                </div>
                                @error('password')
                                {{$message}}
                                @enderror
                                <div class="mb-2 mb-sm-0">
                                    <div>
                                        <input type="password" name="password" placeholder="*** Votre mot de passe"  class="p-1 mb-4">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary mb-3" value="Log in">
                            </form>
                    
                        </div>
                        <div class="beforeBeforeLeftBox">
                        <div class="beforeLeftBox">
                        <div class="leftBox">
                        </div>
                        </div>
                        </div>
                </div>
            </main>
    </div>
@endsection
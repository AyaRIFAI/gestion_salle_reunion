<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use App\Models\User;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use phpDocumentor\Reflection\Types\Null_;

class RegistrationController extends Controller
{
    public function create(){
        $departements=Departement::all();
        return view('registrationViews.addProfForm', ['departements'=>$departements]);
    }
    public function store(Request $request){
        $request->validate(
            ['lastName'=> ['bail','required', 'alpha'],
            'firstName'=> ['bail','required', 'alpha'],
            'Tel'=>['bail', 'required', 'unique:profs,Tel'],
            'email'=>['bail', 'required', 'unique:profs,email','unique:users,email', 'email'],
        'departement_id'=>['bail', 'required', 'exists:departements,id'],
    'path_image'=>['image']]);
    $fullName=$request->lastName.' '.$request->firstName;
    $initial_password=Str::random(5);
    $user=User::create(['name'=>$fullName, 'email'=>$request->email, 'password'=>$initial_password, 'initial_password'=>$initial_password]);
    $name=Null;
    if($request->path_image){
        $fileName=time().'.'.$request->path_image->extension();
        $name=$request->path_image->storeAs('profs', $fileName, 'public');
    }
    //$request->path_image->path();
        Prof::create(['lastName'=> $request->lastName, 'firstName'=>$request->firstName,'Tel'=>$request->Tel, 'path_image'=>$name,'email'=>$request->email,'departement_id'=>$request->departement_id, 'user_id'=>$user->id]);
        event(new Registered($user));
        //send notification to admin thar an email have sent to the prof
       return view('auth.verify-email');
    }
}

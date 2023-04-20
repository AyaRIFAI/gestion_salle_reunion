<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ProfController extends Controller
{
    public function list(){
        //if($user->can('viewAny')){
            $profs=Prof::all();
            $departements=Departement::all();
            return view('profViews.profsList',['profs'=>$profs, 'departements'=>$departements]);
       // }
       
    }
    public function listInitialsPasswords(){
        //if($user->can('viewAny')){
            $profs=Prof::all();
            return view('profViews.profs_initials_passwords',['profs'=>$profs]);
       // }
       
    }
    
   
    public function deleteProfformulaire(){
        return view('profViews.deleteProfForm');
    }
    public function delete(Request $request){
        $request->validate(
            ['email'=> ['bail','required', 'exists:profs,email'],
        ]);
       Prof::where('email', $request->email)->delete();
       User::where('email', $request->email)->delete();
            return redirect()->route('listProf');
        
    }
    public function profDetails($id){
       
         /** @var \App\Models\User */
        $user=Auth::user();
        $prof=Prof::findOrFail($id);
        if($user->can('view',[Prof::class, $prof])){
        return view('profViews.profDetails', ['prof'=>$prof]);
    }
    else{
        abort(403);
    }
}
    public function profUpdate($id){
         /** @var \App\Models\User */
         $user=Auth::user();
         $prof=Prof::findOrFail($id);
         if($user->can('update',[Prof::class, $prof])){
            $departements=Departement::all();
            return view('profViews.profUpdate', ['prof'=>$prof, 'departements'=>$departements]);
    }else{
        abort(403);
    }
}
    public function update(Request $request, $id){
         /** @var \App\Models\User */
        $user=Auth::user();
         $prof=Prof::findOrFail($id);
         if($user->can('update',[Prof::class, $prof])){
        if($request->Tel != $prof->Tel){
        $request->validate(['Tel'=>['bail', 'required', 'unique:profs,Tel']]);
        }
        if($request->email != $prof->email){
            $request->validate(['email'=>['bail', 'required', 'unique:profs,email', 'unique:users,email']]);
            
        }
        $request->validate(['lastName'=> ['bail','required', 'alpha'],
        'firstName'=> ['bail','required', 'alpha'],
        'departement_id'=>['bail', 'required', 'exists:departements,id'], 'path_image'=>['image']]);
        $name=Null;
    if($request->path_image){
        $fileName=time().'.'.$request->path_image->extension();
        $name=$request->path_image->storeAs('profs', $fileName, 'public');
    }
        $prof->update(['lastName'=>$request->lastName, 'firstName'=>$request->firstName, 'Tel'=>$request->Tel, 'email'=>$request->email, 'departement_id'=>$request->departement_id, 'path_image'=>$name]);
        
        $fullName=$request->lastName.' '.$request->firstName;
        if($prof->user->email === $request->email){
            $prof->user->update(['name'=>$fullName, 'email'=>$request->email]);
        }
        else{
            
            $prof->user->update(['name'=>$fullName, 'email'=>$request->email, 'email_verified_at'=>null]);
            //event(new Registered($user));
        }
        return redirect()->route('detailsProf', ['id'=>$id]);
    }else{
        abort(403);
    }
    }
   
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartementController extends Controller
{
    public function addDepartementformulaire(){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        return view('departementViews.addDepartementForm');
    }
    public function deleteDepartementformulaire(){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        return view('departementViews.deleteDepartementForm');
    }
    public function store(Request $request){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $request->validate(
            ['name'=> ['bail','required', 'unique:departements,name'],
            'sigle'=>['bail', 'required', 'unique:departements,sigle', 'max:5']]);
        Departement::create(['name'=> $request->name, 'sigle'=>$request->sigle,'description'=>$request->description]);
            return redirect()->route('listDepartement');
    }
    public function delete(Request $request){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $request->validate(
            ['name'=> ['bail','required', 'exists:departements,name']]);
           Departement::where('name', $request->name)->delete();
            return redirect()->route('listDepartement');

    }
    public function list(){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $resultats=DB::table('profs')->join('departements', 'profs.departement_id', 'departements.id')
        ->select('departements.sigle', 'departements.name', 'profs.lastName', 'profs.firstName', 'profs.email')
        ->get();
         $departements=Departement::all();
        // $resultat=[];
        // foreach($departements as $departement){
        //     array_push($resultat, $departement->profs);
        // }
        // dd($resultat);
        return view('departementViews.departementsList', ['departements'=>$departements, 'resultats'=>$resultats]);
    }
    public function departementDetails($id)
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $departement=Departement::findOrFail($id);
        return view('departementViews.departementDetails', ['departement'=>$departement]);
    }
    public function departementUpdate($id){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $departement=Departement::findOrFail($id);
        return view("departementViews.departementUpdate", ['departement'=>$departement]);
    }
    public function update(Request $request, $id){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $departement=Departement::findOrFail($id);
        if($departement->name === $request->name){
           
        }else{
            $request->validate(
                ['name'=> ['bail','required', 'unique:departements,name'],
                'sigle'=>['bail', 'required', 'unique:departements, name']
           ]);
        }
        $departement->update(['name'=> $request->name, 'sigle'=> $request->sigle]);

        $resultats=DB::table('profs')->join('departements', 'profs.departement_id', 'departements.id')
        ->select('departements.sigle', 'departements.name', 'profs.lastName', 'profs.firstName', 'profs.email')
        ->get();
         $departements=Departement::all();

            return view('departementViews.departementsList', ['departements'=>$departements, 'resultats'=>$resultats]);
        }
}

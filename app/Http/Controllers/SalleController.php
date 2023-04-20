<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SalleController extends Controller
{
    public function addSalleformulaire(){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        return view('salleViews.addSalleForm');
    }
    public function deleteSalleformulaire(){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        return view('salleViews.deleteSalleForm');
    }
    public function store(Request $request){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $request->validate(
            ['name'=> ['bail','required', 'unique:salles,name'],
            'surface'=>['bail','required', 'numeric'],
            'description'=>['bail', 'required'],
            'path_image'=>['image']]);
            $name=null;
            if($request->path_image){
                $fileName=time().'.'.$request->path_image->extension();
                $name = $request->path_image->storeAs(
                'salles', $fileName, 'public'
            );
            }
            
            Salle::create(['name'=> $request->name, 'path_image'=>$name, 'surface'=>$request->surface, 'description'=>$request->description]);
            return redirect()->route('listSalle');
    }
    public function delete(Request $request){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $request->validate(
            ['name'=> ['bail','required', 'exists:salles,name']]);
           Salle::where('name', $request->name)->delete();
            return redirect()->route('listSalle');

    }
    public function list(){
        $salles=Salle::all();
        return view('salleViews.sallesList', ['salles'=>$salles]);
    }
    public function salleDetails($id){
        $salle=Salle::findOrFail($id);
        return view('salleViews.salleDetails', ['salle'=>$salle]);
    }
    public function salleUpdate($id){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $salle=Salle::findOrFail($id);
        return view('salleViews.salleUpdate', ['salle'=>$salle]);
    }
    public function update($id, Request $request){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $salle=Salle::findOrFail($id);
        if($salle->name === $request->name){
            $request->validate(
                ['surface'=>['bail','required', 'numeric'],
                'description'=>['bail', 'required'],
            'path_image'=>['image']]);
        }else{
            $request->validate(
                ['name'=> ['bail','required', 'unique:salles,name'],
                'surface'=>['bail','required', 'numeric'],
                'description'=>['bail', 'required'],  'path_image'=>['image']]);
        }
        $name=Null;
        if($request->path_image){
            $fileName=time().'.'.$request->path_image->extension();
            $name=$request->path_image->storeAs('profs', $fileName, 'public');
        }
            $salle->update(['name'=> $request->name,'surface' =>$request->surface, 'description'=>$request->description, 'path_image'=>$name]);
            $salles=Salle::all();
            return view('salleViews.sallesList', ['salles'=>$salles]);

    }
}

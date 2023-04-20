<?php

namespace App\Http\Controllers;
use App\Models\Salle;
use App\Models\Reunion;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
/* state=0 neutre => not yet answered by the administrator;
state=1 accepted;
state=-1 waiting demand;
state>1 modified reservation neutre and state = original_reservation_id +1;
state<-1 modified reservation waiting and state= -1 - original_reservation_id;
state=Null refused reservation demand
*/
class ReservationController extends Controller
{
    public function addReservationFormulaire(){
        return view('reservationViews.addReservationForm');
    }
    public function addReservationReunion(Request $request){
        $request->validate(['salle'=>['bail', 'required', 'exists:salles,name'],
            'motif'=>['bail', 'required'],
             'reunion_date'=>['bail', 'required', 'date'],
              'beginning_hour'=>['bail', 'required', 'date_format:H:i'],
               'finish_reunion_hour'=>['bail', 'required', 'date_format:H:i', 'after:beginning_hour']]);
               $reunion=Reunion::create(['reunion_date'=>$request->reunion_date, 
               'beginning_hour'=>$request->beginning_hour,
               'finish_reunion_hour'=>$request->finish_reunion_hour]);
               $salle=Salle::where('name','=', $request->salle)->get()->first();
        if (session('isAdmin')) {
            Reservation::create(['motif'=>$request->motif,'salle_id'=>$salle->id,'reunion_id'=>$reunion->id,'isFromAdmin'=>1, 'state'=>1]);
            return redirect('/reservations/actuals');


        }
        else{
               Reservation::create(['motif'=>$request->motif,'salle_id'=>$salle->id,'reunion_id'=>$reunion->id,'prof_id'=>session('prof_id'), 'state'=>0]);
               return redirect('/reservations/prof/send/'.session('prof_id'));
        }
      
    }
    public function acceptReservation($id){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $reservation=Reservation::findOrFail($id);
        $reservation->update(['state'=>1]);
        return Redirect::to(url()->previous());
    }
    public function waitingReservation($id){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $reservation=Reservation::findOrFail($id);
        $reservation->update(['state'=>-1]);
        return Redirect::to(url()->previous());
    }
    public function deleteReservation($id){
       
        $reservation=Reservation::findOrFail($id);
        $reunion=Reunion::findOrFail($reservation->reunion_id);
        $reservation->delete();
        $reunion->delete();
        return Redirect::to(url()->previous());
    }
    public function refuseReservation($id){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $reservation=Reservation::findOrFail($id);
       
        $reservation->update(['state'=>null]);
        return Redirect::to(url()->previous());
    }
    public function showActualReservations($i=null){
        $first=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.id','reservations.motif','reservations.prof_id', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 1)
        ->whereTime('reunions.finish_reunion_hour', '>', date('H:i'))
        ->whereDate('reunions.reunion_date', date('Y-m-d'));

        $all=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.id', 'reservations.motif', 'reservations.prof_id','salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 1)
        ->whereDate('reunions.reunion_date','>', date('Y-m-d'))
        ->union($first)
        ->orderBy('reunion_date')
        ->get();
        $all2=$this->showActualReservationsOfAdmin();
        if($i==null){;
            return view('reservationViews.showReservations', ['all'=>$all, 'all2'=>$all2, 'title'=>'Les réservations actuels', 'i'=>0, 'j'=>0, 'nameRoute'=> 'imprimerActualsReserv']);
        }else{
            return [$all, $all2];
        }
    }
    public function showActualReservationsOfAdmin(){
        $first2=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->select('reservations.id','reservations.motif', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour')
        ->where('reservations.state', 1)
        ->where('reservations.prof_id', null)
        ->whereTime('reunions.finish_reunion_hour', '>', date('H:i'))
        ->whereDate('reunions.reunion_date', date('Y-m-d'));

        $all2=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->select('reservations.id','reservations.motif','salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour')
        ->where('reservations.state', 1)
        ->where('reservations.prof_id', null)
        ->whereDate('reunions.reunion_date','>', date('Y-m-d'))
        ->union($first2)
        ->orderBy('reunion_date')
        ->get();
        return $all2;
    }
    public function showActualReservationsOfProfSend($id){
        $first=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.id','reservations.motif','reservations.updated_at', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 0)
        ->where('profs.id', $id)
        ->whereTime('reunions.finish_reunion_hour', '>', date('H:i'))
        ->whereDate('reunions.reunion_date', date('Y-m-d'));

        $all=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.id','reservations.motif', 'reservations.updated_at','salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 0)
        ->where('profs.id', $id)
        ->whereDate('reunions.reunion_date','>', date('Y-m-d'))
        ->union($first)
        ->orderBy('reunion_date')
        ->get();
        return view('reservationViews.showReservationsOfProf', ['all'=>$all, 'title'=>'Les demandes de réservations envoyés par vous', 'i'=>0]);
    }
    public function showActualReservationsAcceptedOfProf($id){
        $first=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.id','reservations.motif','reservations.updated_at', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 1)
        ->where('profs.id', $id)
        ->whereTime('reunions.finish_reunion_hour', '>', date('H:i'))
        ->whereDate('reunions.reunion_date', date('Y-m-d'));

        $all=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.id','reservations.motif', 'reservations.updated_at','salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 1)
        ->where('profs.id', $id)
        ->whereDate('reunions.reunion_date','>', date('Y-m-d'))
        ->union($first)
        ->orderBy('reunion_date')
        ->get();
         return view('reservationViews.showReservationsOfProf', ['all'=>$all, 'title'=>'Vos demandes de réservations actuelles acceptées', 'i'=>1]);
    }
    public function showActualReservationsOfSalle($id){
        $salle=Salle::findOrFail($id);
        $first=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.motif', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 1)
        ->where('reservations.salle_id', $id)
        ->whereTime('reunions.finish_reunion_hour', '>', date('H:i'))
        ->whereDate('reunions.reunion_date', date('Y-m-d'));

        $all=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.motif', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 1)
        ->where('reservations.salle_id', $id)
        ->whereDate('reunions.reunion_date','>', date('Y-m-d'))
        ->union($first)
        ->orderBy('reunion_date')
        ->get();
        $all2=$this->showActualReservationsOfSalleByAdmin($id);
        return view('reservationViews.showReservations', ['all'=>$all, 'all2'=>$all2, 'title'=>'Les réservations actuels de la '.$salle->name, 'i'=>1, 'j'=>0, 'nameRoute'=>null]);
    }
    public function showActualReservationsOfSalleByAdmin($id){
        $first2=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->select('reservations.id','reservations.motif', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour')
        ->where('reservations.state', 1)
        ->where('reservations.salle_id', $id)
        ->where('reservations.prof_id', null)
        ->whereTime('reunions.finish_reunion_hour', '>', date('H:i'))
        ->whereDate('reunions.reunion_date', date('Y-m-d'));

        $all2=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->select('reservations.id','reservations.motif','salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour')
        ->where('reservations.state', 1)
        ->where('reservations.salle_id', $id)
        ->where('reservations.prof_id', null)
        ->whereDate('reunions.reunion_date','>', date('Y-m-d'))
        ->union($first2)
        ->orderBy('reunion_date')
        ->get();
        return $all2;
    }
    public function showAllReservations($i=null){
        $all=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.motif', 'reservations.prof_id','salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 1)
        ->orderBy('reunion_date', 'desc')
        ->get();
        $all2=$this->showAllReservationsByAdmin();

        if($i==null){
            return view('reservationViews.showReservations', ['all'=>$all, 'all2'=>$all2, 'title'=>'Historique des réservations', 'i'=>0, 'j'=>0,  'nameRoute'=> 'imprimerAllReserv']);
        }else{
            return [$all,$all2];
        }
    }
    public function showAllReservationsByAdmin(){
        $all2=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->select('reservations.id','reservations.motif', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour')
        ->where('reservations.state', 1)
        ->where('reservations.prof_id', null)
        ->orderBy('reunion_date', 'desc')
        ->get();
        return $all2;
    }
    public function showAllReservationsOfSalle($id){
        $salle=Salle::findOrFail($id);
        $all=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.motif', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 1)
        ->where('reservations.salle_id', $id)
        ->orderBy('reunion_date', 'desc')
        ->get();
        $all2=$this->showAllReservationsOfSalleByAdmin($id);
        return view('reservationViews.showReservations', ['all'=>$all, 'all2'=>$all2, 'title'=>'Historique des réservations de la '. $salle->name.' ', 'i'=>1, 'j'=>0, 'nameRoute'=>null]);
    }
    public function showAllReservationsOfSalleByAdmin($id){
        $all2=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->select('reservations.id','reservations.motif', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour')
        ->where('reservations.state', 1)
        ->where('reservations.salle_id', $id)
        ->where('reservations.prof_id', null)
        ->orderBy('reunion_date', 'desc')
        ->get();
        return $all2;
    }
    public function updateReservationFormulaire($id){
        $reservation=Reservation::findOrFail($id);
        return view('reservationViews.updateReservationFormulaire', ['reservation'=>$reservation]);
    }
     public function demandeUpdateReservation(Request $request, $id)
    {
        $request->validate(['salle'=>['bail', 'required', 'exists:salles,name'],
        'motif'=>['bail', 'required'],
         'reunion_date'=>['bail', 'required', 'date'],
          'beginning_hour'=>['bail', 'required', 'date_format:H:i'],
           'finish_reunion_hour'=>['bail', 'required', 'date_format:H:i', 'after:beginning_hour']]);
           $reservation=Reservation::findOrFail($id);
           $salle=Salle::where('name','=', $request->salle)->get()->first();
           if($reservation->state==0){
            $reservation->reunion->update(['reunion_date'=>$request->reunion_date, 
            'beginning_hour'=>$request->beginning_hour,
            'finish_reunion_hour'=>$request->finish_reunion_hour]);
            $reservation->update(['motif'=>$request->motif,'salle_id'=>$salle->id]);
            return redirect('/reservations/prof/send/'.session('prof_id'));
           }
           elseif($reservation->state!=0 || $reservation->state!=null){
            $originalIdInceremente=$reservation->id+1;
            $reunion=Reunion::create(['reunion_date'=>$request->reunion_date, 
            'beginning_hour'=>$request->beginning_hour,
            'finish_reunion_hour'=>$request->finish_reunion_hour]);
            Reservation::create(['motif'=>$request->motif,'salle_id'=>$salle->id,'reunion_id'=>$reunion->id,'prof_id'=>session('prof_id'), 'state'=>$originalIdInceremente]);
            return redirect('/');
           }
           
           
           
    }
    public function acceptUpdateReservation($id){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $newReservation=Reservation::findOrFail($id);
        if($newReservation->state>1){
            $idOriginel=($newReservation->state)-1;
        }
        elseif($newReservation->state<-1){
            $idOriginel=-1-$newReservation->state;
        }
        
        $this->deleteReservation($idOriginel);
        $newReservation->update(['state'=>1]);
        return Redirect::to(url()->previous());    }

    public function waitUpdateReservation($id){
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $newReservation=Reservation::findOrFail($id);
        $idOriginelCrypted=-$newReservation->state;//-1-($newReservation->state-1)
        $newReservation->update(['state'=>$idOriginelCrypted]);
        return Redirect::to(url()->previous());    
    }
    public function listUpdateReservation(){
        
        $newReservations=Reservation::where('state', '>', 1)->get();
        $origins=[];
        foreach($newReservations as $newReservation){
            $id=$newReservation->state-1;
            $origins[]=Reservation::findOrfail($id);
        }
        
    
        return view('reservationViews.listUpdateReservation', ['newReservations'=>$newReservations,'origins'=>$origins]);
    }
    public function listUpdateReservationByProf($id){
        
        $newReservations=Reservation::where('state', '>', 1)->where('prof_id', $id)->get();
        $origins=[];
        foreach($newReservations as $newReservation){
            $id=$newReservation->state-1;
            $origins[]=Reservation::findOrfail($id);
        }
        
    
        return view('reservationViews.listUpdateReservation', ['newReservations'=>$newReservations,'origins'=>$origins]);
    }
    public function listWaitUpdateReservation(){
        $newReservations=Reservation::where('state', '<', -1)->get();
        $origins=[];
        foreach($newReservations as $newReservation){
            $id=-1-$newReservation->state;
            $origins[]=Reservation::findOrfail($id);
        }
        
    
        return view('reservationViews.listWaitUpdateReservation', ['newReservations'=>$newReservations,'origins'=>$origins]);
    }
    public function listWaitUpdateReservationByProf($id){
        $newReservations=Reservation::where('state', '<', -1)->where('prof_id', $id)->get();
        $origins=[];
        foreach($newReservations as $newReservation){
            $id=-1-$newReservation->state;
            $origins[]=Reservation::findOrfail($id);
        }
        
    
        return view('reservationViews.listWaitUpdateReservation', ['newReservations'=>$newReservations,'origins'=>$origins]);
    }
    public function listWaitReservation(){
        $reservations=Reservation::where('state', -1)->get();
        return view('reservationViews.listWaitReservation', ['reservations'=>$reservations]);
    }
    public function listWaitReservationByProf($id){
        $reservations=Reservation::where('state', -1)->where('prof_id', $id)->get();
        return view('reservationViews.listWaitReservation', ['reservations'=>$reservations]);
    }
    public function listRefusedReservation(){
        $reservations=Reservation::where('state', null)->get();
        return view('reservationViews.listRefusedReservation', ['reservations'=>$reservations]);
    }
    public function listRefusedReservationByProf($id){
        $reservations=Reservation::where('state', null)->where('prof_id', $id)->get();
        return view('reservationViews.listRefusedReservation', ['reservations'=>$reservations]);
    }
    public function showDemandedReservations(){
        $first=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.id', 'reservations.motif', 'reservations.updated_at','salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 0)
        ->whereTime('reunions.finish_reunion_hour', '>', date('H:i'))
        ->whereDate('reunions.reunion_date', date('Y-m-d'));

        $all=DB::table('reservations')->join('reunions', 'reservations.reunion_id', '=', 'reunions.id')
        ->join('salles', 'reservations.salle_id', '=', 'salles.id')
        ->join('profs', 'reservations.prof_id', '=', 'profs.id')
        ->select('reservations.id','reservations.motif', 'reservations.updated_at', 'salles.name', 'reunions.reunion_date', 'reunions.beginning_hour', 'reunions.finish_reunion_hour', 'profs.lastName', 'profs.firstName')
        ->where('reservations.state', 0)
        ->whereDate('reunions.reunion_date','>', date('Y-m-d'))
        ->union($first)
        ->orderBy('reunion_date')
        ->get();
        return view('reservationViews.showReservations', ['all'=>$all, 'title'=>'Les demandes de réservation actuelles', 'i'=>0, 'j'=>1, 'all2'=> null, 'nameRoute'=>null]);
    }
    public function getActualReservationPdf ()
{
    // L'instance PDF avec une vue : resources/views/posts/show.blade.php
    $array=$this->showActualReservations(1);
    $all=$array[0];
    $all2=$array[1];
    $title='Les réservations actuelles';
    $i=0;
    $j=0;
    $pdf=Pdf::loadView('reservationViews.showReservationsImprim', compact('all','all2', 'title','i', 'j'));
    return $pdf->stream('reservationsActuelles.pdf');
}
public function getAllReservationPdf ()
{
    // L'instance PDF avec une vue : resources/views/posts/show.blade.php
    $array=$this->showAllReservations(1);
    $all=$array[0];
    $all2=$array[1];
    $title="L'historique des reservations";
    $i=0;
    $j=0;
    $pdf=Pdf::loadView('reservationViews.showReservationsImprim', compact('all','all2', 'title', 'i', 'j'));
    return $pdf->stream('historiqueReservations.pdf');
}
}   

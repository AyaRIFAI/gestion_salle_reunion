<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ChangePasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
})->middleware(['auth','verified']);
Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/authenticate',[LoginController::class, 'authenticate']);
Route::get('/logout', function(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');

Route::post('/email/verificationNotification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/home', [LoginController::class, 'goHome'])->middleware(['auth','verified']);

Route::get('/salles',[SalleController::class, 'list'])->middleware(['auth','verified'])->name('listSalle');
Route::get('/salles/details/{id}',[SalleController::class, 'salleDetails'])->middleware(['auth', 'verified'])->name('salleDetails');
Route::get('/salles/update/{id}',[SalleController::class, 'salleUpdate'])->middleware(['auth', 'verified'])->name('update1');
Route::post('/salles/update/{id}',[SalleController::class, 'update'])->middleware(['auth', 'verified'])->name('updateStore');
Route::get('/salles/add',[SalleController::class, 'addSalleformulaire'])->middleware(['auth', 'verified']);
Route::post('/salles/add',[SalleController::class, 'store'])->name('addSalle')->middleware(['auth', 'verified']);
Route::get('/salles/delete',[SalleController::class, 'deleteSalleformulaire'])->middleware(['auth', 'verified']);
Route::post('/salles/delete',[SalleController::class, 'delete'])->middleware(['auth', 'verified']);

Route::get('/departements',[DepartementController::class, 'list'])->middleware(['auth', 'verified'])->name('listDepartement');
Route::get('/departements/details/{id}',[DepartementController::class, 'departementDetails'])->middleware(['auth', 'verified'])->name('departementDetails');
Route::get('/departements/update/{id}', [DepartementController::class, 'departementUpdate'])->middleware(['auth', 'verified'])->name('departementUpdate');
Route::post('/departements/update/{id}', [DepartementController::class, 'update'])->middleware(['auth', 'verified'])->name('update');
Route::get('/departements/add',[DepartementController::class, 'addDepartementformulaire'])->middleware(['auth', 'verified']);
Route::post('/departements/add',[DepartementController::class, 'store'])->middleware(['auth', 'verified'])->name('addDepartement');
Route::get('/departements/delete',[DepartementController::class, 'deleteDepartementformulaire'])->middleware(['auth', 'verified']);
Route::post('/departements/delete',[DepartementController::class, 'delete'])->middleware(['auth', 'verified']);

Route::get('/profs',[ProfController::class, 'list'])->middleware(['auth','verified','can:viewAny,App\Models\Prof'])->name('listProf');
Route::get('/profs/details/{id}',[ProfController::class, 'profDetails'])->middleware(['auth', 'verified'])->name('detailsProf');
Route::get('/profs/update/{id}',[ProfController::class, 'profUpdate'])->middleware(['auth', 'verified'])->name('updateProf1')->whereNumber('id');
Route::post('/profs/update/{id}',[ProfController::class, 'update'])->middleware(['auth', 'verified'])->name('updateProf2')->whereNumber('id');
Route::get('/profs/add',[RegistrationController::class, 'create'])->middleware(['auth', 'verified'])->middleware('can:create,App\Models\Prof');
Route::post('/profs/add',[RegistrationController::class, 'store'])->middleware(['auth', 'verified'])->name('addProf');
Route::get('/profs/delete',[ProfController::class, 'deleteProfformulaire'])->middleware(['auth', 'verified']);
Route::post('/profs/delete',[ProfController::class, 'delete'])->middleware(['auth', 'verified']);
Route::get('/profs/initials_passwords', [ProfController::class, 'listInitialsPasswords']);
Route::get('/profs/update/password/{id}', [ChangePasswordController::class, 'updatePasswordForm'])->middleware(['auth', 'verified']);
Route::post('/profs/update/password/{id}', [ChangePasswordController::class, 'updatePassword'])->middleware(['auth', 'verified'])->whereNumber('id')->name('updatePassword');


Route::get('/reservations/add',[ReservationController::class, 'addReservationFormulaire'])->middleware(['auth', 'verified']);
Route::post('/reservations/add',[ReservationController::class, 'addReservationReunion'])->middleware(['auth', 'verified']);
Route::get('/reservations/demands',[ReservationController::class, 'showDemandedReservations'])->middleware(['auth', 'verified']);
Route::get('/reservations/accept/{id}',[ReservationController::class, 'acceptReservation'])->middleware(['auth', 'verified']);
Route::get('/reservations/waiting/{id}',[ReservationController::class, 'waitingReservation'])->middleware(['auth', 'verified'])->whereNumber('id');
Route::get('/reservations/waiting',[ReservationController::class, 'listWaitReservation'])->middleware(['auth', 'verified']);

Route::get('/reservations/delete/{id}',[ReservationController::class, 'deleteReservation'])->middleware(['auth', 'verified']);
Route::get('/reservations/actuals',[ReservationController::class, 'showActualReservations'])->middleware(['auth', 'verified']);
Route::get('/reservations/historic',[ReservationController::class, 'showAllReservations'])->middleware(['auth', 'verified']);
Route::get('/reservations/historic/salle/{id}',[ReservationController::class, 'showAllReservationsOfSalle'])->middleware(['auth', 'verified']);
Route::get('/reservations/actuals/salle/{id}',[ReservationController::class, 'showActualReservationsOfSalle'])->middleware(['auth', 'verified']);
Route::get('/reservations/refuse/{id}', [ReservationController::class, 'refuseReservation'])->middleware(['auth', 'verified'])->whereNumber('id');
Route::get('/reservations/update',[ReservationController::class, 'listUpdateReservation'])->middleware(['auth', 'verified']);
Route::get('/reservations/updated/{id}',[ReservationController::class, 'listUpdateReservationByProf'])->whereNumber('id')->middleware(['auth', 'verified']);
Route::get('/reservations/update/{id}',[ReservationController::class, 'updateReservationFormulaire'])->whereNumber('id')->middleware(['auth', 'verified']);
Route::post('/reservations/update/{id}',[ReservationController::class, 'demandeUpdateReservation'])->middleware(['auth', 'verified'])->name("demandeUpdateReservation");
Route::get('/reservations/update/accept/{id}',[ReservationController::class, 'acceptUpdateReservation'])->middleware(['auth', 'verified']);
Route::get('/reservations/update/waiting',[ReservationController::class, 'listWaitUpdateReservation'])->middleware(['auth', 'verified']);
Route::get('/reservations/update/waiting/{id}',[ReservationController::class, 'waitUpdateReservation'])->middleware(['auth', 'verified']);
Route::get('/reservations/update/prof/waiting/{id}',[ReservationController::class, 'listWaitUpdateReservationByProf'])->middleware(['auth', 'verified']);
Route::get('/reservations/prof/send/{id}',[ReservationController::class, 'showActualReservationsOfProfSend'])->middleware(['auth', 'verified'])->whereNumber('id');
Route::get('/reservations/prof/accepted/{id}',[ReservationController::class, 'showActualReservationsAcceptedOfProf'])->middleware(['auth', 'verified'])->whereNumber('id');
Route::get('/reservations/prof/wait/{id}',[ReservationController::class, 'listWaitReservationByProf'])->middleware(['auth', 'verified'])->whereNumber('id');
Route::get('/reservations/refused/{id}',[ReservationController::class, 'listRefusedReservationByProf'])->middleware(['auth', 'verified'])->whereNumber('id');
Route::get('/reservations/refused',[ReservationController::class, 'listRefusedReservation'])->middleware(['auth', 'verified']);

Route::get('/reservations/actual/imprimer',[ReservationController::class, 'getActualReservationPdf'])->middleware(['auth', 'verified'])->whereNumber('id')->name('imprimerActualsReserv');
Route::get('/reservations/historic/imprimer',[ReservationController::class, 'getAllReservationPdf'])->middleware(['auth', 'verified'])->whereNumber('id')->name('imprimerAllReserv');

 Route::get('/email/verify', function () {
    return view('auth.verify-email');
 })->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/email/confirmed');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::view('/email/confirmed', 'emails.email_confirmed');



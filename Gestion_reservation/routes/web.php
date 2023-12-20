<?php

use App\Models\Evenement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [Controller::class, 'index']);

Auth::routes();

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ajout_evenement', [EvenementController::class, 'create'])->name('ajout_evenement');
Route::post('/evenement/ajoute', [EvenementController::class, 'store']);
Route::get('/evenement/liste', [EvenementController::class, 'index']);
Route::get('/evenement/modifier/{id}', [EvenementController::class,'edit']);
Route::put('/evenement/modifier', [EvenementController::class,'update']);
Route::get('/evenement/supprimer/{id}', [EvenementController::class, 'destroy']);

Route::get('/client/listeEvenementCloture', [EvenementController::class, 'showEvenementCloture'])->name('evenementCloture_liste');

Route::get('/client/listeEvenement', [EvenementController::class, 'show'])->name('evenement_liste');
Route::get('/client/listeEvenementClient', [EvenementController::class, 'showClient'])->name('evenement_listeClient');


Route::get('/reservation/ajoutReservation/{evenement_id}',[ClientController::class, 'create'])->name('reservation.ajout');
Route::post('/reservation/ajoute', [ClientController::class, 'store'])->name('reservation.ajouter');
Route::get('/reservation/listeReservation/{id}', [ClientController::class, 'show']);
Route::get('/reservation/listeReservationRefuse/{id}', [ClientController::class, 'showRefus']);

Route::get('/refuserReservation/{id}', [EvenementController::class, 'updateEtatReservation']);







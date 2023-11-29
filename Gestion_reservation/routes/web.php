<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EvenementController;
use App\Models\Evenement;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ajout_evenement', [EvenementController::class, 'create'])->name('ajout_evenement');
Route::post('/evenement/ajoute', [EvenementController::class, 'store']);
Route::get('/evenement/liste', [EvenementController::class, 'index']);
Route::get('/evenement/modifier/{id}', [EvenementController::class,'edit']);
Route::put('/evenement/modifier', [EvenementController::class,'update']);
Route::get('/evenement/supprimer/{id}', [EvenementController::class, 'destroy']);




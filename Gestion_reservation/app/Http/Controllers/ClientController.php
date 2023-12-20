<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\EmailReservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        // $user = auth()->user();
        $reservations = Reservation::where('est_accepte_ou_pas', 'refuse')->get();
        return view("reservation.listeReservationRefuse", compact("reservations"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($evenement_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $user_id = Auth::user()->id;
    
        $reference = substr(Auth::user()->nom, 0, 3) . $user_id . date('y');
    
    
        return view('reservation.ajoutReservation', [
            'evenement_id' => $evenement_id,
            'user_id' => $user_id,
            'reference' => $reference,
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nombre_de_place' => 'required|min:1',
    ]);


    $user = Auth::user();
    $evenement_id = $request->get('evenement_id');
    $reservations = new Reservation();
    $existingReservation = Reservation::where('user_id', $user->id)
    ->where('evenement_id', $evenement_id)
    ->first();

if ($existingReservation) {
    $existingReservation->nombre_de_place += $request->get('nombre_de_place');
    if($existingReservation->save()){
        return redirect('/client/listeEvenementClient');

    }
} else {
    $reservations->user_id = $user->id;
    $reservations->evenement_id = $request->get('evenement_id');

    $numero_unique = time();

    $reference = substr($user->nom, 0, 3) . $user->id . date('y') . $numero_unique;
    
    $reservations->reference = $reference;
    $reservations->nombre_de_place = $request->get('nombre_de_place');
    $reservations->user_id = $user->id;
    $reservations->evenement_id = $request->get('evenement_id');

    if ($reservations->save()) {
        $content = [
            'title' => 'Confirmation de résérvation',
            'body' => 'Votre résérvation a été éffectuée avec succès',
        ];

        Mail::to($user->email)->send(new EmailReservation($content));
        return redirect('/client/listeEvenementClient');
    }
}
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservations = Reservation::where('evenement_id', $id)->get();
        return view("reservation.listeReservation", compact("reservations"));
    }
    public function showRefus($id)
    {
        $reservations = Reservation::where('evenement_id', $id)->where('est_accepte_ou_pas', 'accepte')->get();
        // $user=User::find($id);
        return view("reservation.listeReservation", compact("reservations"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}

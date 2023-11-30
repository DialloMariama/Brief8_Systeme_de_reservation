<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //  $reservations = Reservation::all();
    //  return view("reservation.listeReservation", compact("reservations"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($evenement_id)
    {
        return view('reservation.ajoutReservation', ['evenement_id' => $evenement_id]);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required',
            'nombre_de_place' => 'required|min:1',
        ]);


        $reservations = new Reservation();
        $reservations->reference = $request->get('reference');
        $reservations->nombre_de_place = $request->get('nombre_de_place');
        
        $reservations->user_id = $request->get('user_id');
        $reservations->evenement_id = $request->get('evenement_id');


        if ($reservations->save()) {
            echo 'ajout reussi';
            return redirect('/client/listeEvenementClient');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservations = Reservation::where('evenement_id', $id)->get();
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

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evenement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\EmailReservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use App\Mail\RefusReservation;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        // $evenements = Evenement::all();
        $evenements = Evenement::where('user_id', $user->id)->where('est_cloturer_ou_pas', 'En_cours')->get();
        return view("association.listeEvenement", compact("evenements", "user"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("association.ajoutEvenement");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'date_limite_inscription' => 'required',
            'image_mise_en_avant' => 'required|image|',
            'description' => 'required',
            'est_cloturer_ou_pas' => 'required',
            'lieu' => 'required',
            'date_evenement' => 'required',
        ]);


        $evenement = new Evenement();
        $evenement->libelle = $request->get('libelle');
        $evenement->date_limite_inscription = $request->get('date_limite_inscription');
        $evenement->image_mise_en_avant = $this->storeImage($request->file('image_mise_en_avant'));
        $evenement->description = $request->get('description');
        $evenement->est_cloturer_ou_pas = $request->get('est_cloturer_ou_pas');
        $evenement->date_evenement = $request->get('date_evenement');
        $evenement->lieu = $request->get('lieu');
        $evenement->user_id = auth()->user()->id;
        if ($evenement->save()) {

            echo 'ajout reussi';
            return redirect('/evenement/liste');
        }
    }
    private function storeImage($image_mise_en_avant): string
    {
        if ($image_mise_en_avant->isValid()) {
            return $image_mise_en_avant->store('images', 'public');
        } else {
            return 'Erreur lors du téléchargement de l\'image.';
        }
    }


    /**
     * Display the specified resource.
     */
    public function showEvenementCloture()
    {
        $evenements = Evenement::where('est_cloturer_ou_pas', 'Cloture')->get();
        return view('association.listeEvenementCloture', compact('evenements'));
    }
    public function show()
    {
        $evenements = Evenement::where('est_cloturer_ou_pas', 'En_cours')->get();
        return view('client.listeEvenement', compact('evenements'));
    }
    public function showClient()
    {
        $evenements = Evenement::where('est_cloturer_ou_pas', 'En_cours')->get();
        return view('client.listeEvenementClient', compact('evenements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $evenement = Evenement::find($id);
        return view('association.modifierEvenement', compact('evenement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'date_limite_inscription' => 'required',
            'image_mise_en_avant',
            'description' => 'required',
            'est_cloturer_ou_pas' => 'required',
            'lieu' => 'required',
            'date_evenement' => 'required',
        ]);


        $evenement =  evenement::find($request->id);

        $evenement->libelle = $request->get('libelle');
        $evenement->date_limite_inscription = $request->get('date_limite_inscription');
        if ($request->hasFile("image_mise_en_avant")) {
            $evenement->image_mise_en_avant = $this->storeImage($request->image_mise_en_avant);
        }
        $evenement->description = $request->get('description');
        $evenement->est_cloturer_ou_pas = $request->get('est_cloturer_ou_pas');
        $evenement->date_evenement = $request->get('date_evenement');
        $evenement->lieu = $request->get('lieu');

        $evenement->Update();
        return redirect('/evenement/liste');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evenement = Evenement::find($id);
        if ($evenement->delete()) {
            return redirect('/evenement/liste');
        }
    }

    public function updateEtatReservation($id)
    {

        $reservation = Reservation::find($id);
        $users = User::all();
        $reservation->est_accepte_ou_pas = 'refuse';
        if ($reservation->update()) {
            foreach ($users as $user) {
                if ($reservation->user_id == $user->id) {
                    $content = [
                        'title' => 'Refus de résérvation',
                        'body' => 'Votre résérvation a été déclinée',
                    ];
                    Mail::to($user->email)->send(new RefusReservation($content));
                }
            }
            return back()->with("La réservation a été déclinée");
        }
    }
}

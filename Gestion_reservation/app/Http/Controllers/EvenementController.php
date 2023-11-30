<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $evenements = Evenement::all();
        // $evenements = Evenement::where('user_id', $user->id)->get()();
        return view("association.listeEvenement", compact("evenements"));
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
        $evenement->association_id = auth()->user()->id;

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
    public function show()
    {
        $evenements = Evenement::all();
        return view('client.listeEvenement', compact('evenements'));
    }
    public function showClient()
    {
        $evenements = Evenement::all();
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
        if ($request->hasFile("image_mise_en_avant")) 
        {
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
}

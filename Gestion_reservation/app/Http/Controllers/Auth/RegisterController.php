<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Client;
use App\Models\Association;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function registered(Request $request, $user)
    {
        if ($user->role === 'association') {
            return redirect()->route('ajout_evenement');
        } elseif ($user->role === 'client') {
            return redirect()->route('evenement_listeClient');
        }

        return redirect($this->redirectTo);
    }
    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        if($data['role']=='client'){

        
        return Validator::make($data, [
            
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:association,client',
            'nom' => 'required_if:role,association|string|max:255',
            'telephone' => 'required_if:role,client|string|max:255',
        ]);
    }else{
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:association,client',
            'nom' => 'required_if:role,association|string|max:255',
            'slogan' => 'required_if:role,association|string|max:255',
            'logo' => 'required_if:role,association|string|max:255',
            'date_creation' => 'required_if:role,association|date',

        ]);

    }
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    
        // ... (votre code actuel)

    
    protected function create(array $data)
    {
        try {
        $user = User::create([
            'nom' => $data['nom'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
        if ($data['role'] === 'association') {
            Association::create([
                'user_id' => $user->id,
                'nom' => $data['nom'],
                'slogan' => $data['slogan'],
                'logo' => $data['logo'],
                'date_creation' => $data['date_creation'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        } elseif ($data['role'] === 'client') {
            Client::create([
                'user_id' => $user->id,
                'nom' => $data['nom'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'password' => bcrypt($data['password']),
            ]);
        }
    
        return $user;
    } catch (\Exception $e) {
            // Ajoutez des logs pour voir les erreurs
            Log::error("Erreur lors de l'inscription : " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\nLigne : " . $e->getLine());

            throw $e;
        }

    }
}

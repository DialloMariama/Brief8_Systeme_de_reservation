@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="/evenement/liste" class="btn btn-primary btn-sm">Liste Evenement</a>

    <div class="card">
        <div class="card-header">
            <h2 class="offset-4">LISTE DES RESERVATIONS</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Référence</th>
                    <th>Nombre de places</th>
                    <th>Date Inscription</th>
                    <th>État</th>
                    <th>Utilisateur</th>
                    <th>Événement</th>
                    <th>Action</th>
                </tr>
                @foreach($reservations as $reservation)
                <tr>
                    <td>{{$reservation->reference}}</td>
                    <td>{{$reservation->nombre_de_place}}</td>
                    <td>{{$reservation->created_at}}</td>
                    <td>{{$reservation->est_accepte_ou_pas}}</td>
                    <td>{{$reservation->user ? $reservation->user->nom : 'Utilisateur inconnu'}}</td>
                    <td>{{$reservation->evenement ? $reservation->evenement->libelle : 'Événement inconnu'}}</td>
                    <td>
                        <a href="/refuserReservation/{{$reservation->id}}" class="btn btn-warning btn-sm">Decliner</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

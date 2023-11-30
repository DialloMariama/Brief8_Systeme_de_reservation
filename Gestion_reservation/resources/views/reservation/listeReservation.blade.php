@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h2 class="offset-4">LISTE DES EVENEMENTS</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Client</th>
                    <th>evenement</th>
                    <th>reference</th>
                    <th>nombre de places</th>
                    <th>date Inscription</th>
                    <th>Etat/th>

                    <th>ACTION</th>
                </tr>
                @foreach($reservations as $reservation)
                <tr>
                    <td><img src="" alt="" width="100" height="50"></td>
                    <td>{{$reservation->user->nom}}</td>
                    <td>{{$reservation->evenement->libelle}}</td>
                    <td>{{$reservation->reference}}</td>
                    <td>{{$reservation->created_at}}</td>
                    <td>{{$evenement->est_accepte_ou_pas}}</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm">Decliner</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
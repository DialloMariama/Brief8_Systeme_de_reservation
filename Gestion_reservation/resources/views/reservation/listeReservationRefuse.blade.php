@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="/evenement/liste" class="btn btn-primary btn-sm">Liste Evenement</a>
    <div class="card">
        <div class="card-header">
            <h2 class="offset-4">LISTE DES RESERVATION REFUSEES</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>reference</th>
                    <th>nombre de places</th>
                    <th>date Inscription</th>
                    <th>Etat</th>

                </tr>
                @foreach($reservations as $reservation)
                <tr>
                    <td>{{$reservation->reference}}</td>
                    <td>{{$reservation->nombre_de_place}}</td>
                    <td>{{$reservation->created_at}}</td>
                    <td>{{$reservation->est_accepte_ou_pas}}</td>
                   
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
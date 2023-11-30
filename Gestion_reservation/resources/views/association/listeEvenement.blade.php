@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="/ajout_evenement" class="btn btn-primary btn-sm">Ajouter Evenement</a>


    <div class="card">

        <div class="card-header">
            <h2 class="offset-4">LISTE DES EVENEMENTS</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>IMAGE</th>
                    <th>LIBELLE</th>
                    <th>DATE LIMITE</th>
                    <th>DESCRIPTION</th>
                    <th>Etat</th>
                    <th>LIEU</th>
                    <th>DATE EVENEMENT</th>
                    <th>ACTION</th>
                </tr>
                @foreach($evenements as $evenement)
                <tr>
                    <td><img src="{{asset('storage/'.$evenement->image_mise_en_avant)}}" alt="" width="100" height="50"></td>
                    <td>{{$evenement->libelle}}</td>
                    <td>{{$evenement->date_limite_inscription}}</td>
                    <td>{{$evenement->description}}</td>
                    <td>{{$evenement->est_cloturer_ou_pas}}</td>
                    <td>{{$evenement->lieu}}</td>
                    <td>{{$evenement->date_evenement}}</td>
                    <td>
                        <a href="/evenement/modifier/{{$evenement->id}}" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="/evenement/supprimer/{{$evenement->id }}" class="btn btn-danger btn-sm">Supprimer</a>
                        <a href="/reservation/listeReservation/{{$evenement->id }}" class="btn btn-primary btn-sm">liste des reservations</a>

                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
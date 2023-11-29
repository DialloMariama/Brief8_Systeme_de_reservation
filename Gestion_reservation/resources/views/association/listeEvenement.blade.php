@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="offset-4">LISTES DES EVENEMENTS</h2>
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
                    <td><img src="{{asset('storage/'.$evenement->image_mise_en_avant)}}" alt="" width="253" height="100"></td>
                    <td>{{$evenement->libelle}}</td>
                    <td>{{$evenement->date_limite_inscription}}</td>
                    <td>{{$evenement->description}}</td>
                    <td>{{$evenement->est_cloturer_ou_pas}}</td>
                    <td>{{$evenement->lieu}}</td>
                    <td>{{$evenement->date_evenement}}</td>
                    <td>
                        <a href="/evenement/modifier/{{$evenement->id}}" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="/evenement/supprimer/{{$evenement->id }}" class="btn btn-danger btn-sm">Supprimer</a>
                        <!-- <a href="/detailEvenement/{{$evenement->id}}" class="btn btn-secondary">Voir Détails</a> -->
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
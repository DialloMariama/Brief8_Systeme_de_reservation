@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="display-4">Bienvenue à notre site</h1>
    <p class="lead">Découvrez nos événements passionnants et réservez votre place dès maintenant!</p>
    
    <div class="card mb-4 mt-4" style="width: 100%;">
        <img src="{{ asset('images/A28BxsHeADYSXoYdu9GYAynQICQAjH9butxaLS91.png') }}" alt="">
    </div>

    <div class="row">
        @foreach($evenements as $evenement)
            <div class="col-12 col-md-3 mt-4">
                <div class="card">
                    <img src="{{ asset('storage/'.$evenement->image_mise_en_avant) }}" alt="" width="305" height="200">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $evenement->libelle }}</h5>
                            <span class="card-title">{{ $evenement->date_limite_inscription }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $evenement->lieu }}</h5>
                            <span class="card-title">{{ $evenement->est_cloturer_ou_pas }}</span>
                        </div>
                        <h5 class="card-title">{{ $evenement->description }}</h5>
                        <h5 class="card-title">{{ $evenement->date_evenement }}</h5>
                        <a href="{{ route('login') }}" class="btn btn-primary">Réserver</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

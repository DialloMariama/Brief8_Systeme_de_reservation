@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            @foreach($evenements as $evenement)
                <div class="col-12 col-md-3 mt-4">
                    <div class="card">
                          <img src="{{asset('storage/'.$evenement->image_mise_en_avant)}}" alt="" width="305" height="200">
                            
                       
                        <div class="card-body">
                        <div class=" d-flex justify-content-between">
                            <h5 class="card-title">{{$evenement->libelle}}</h5>
                            <span class="card-title"> {{$evenement->date_limite_inscription}}</span>
                            </div>
                            <div class=" d-flex justify-content-between">
                            <h5 class="card-title">{{$evenement->lieu}}</h5>
                            <span class="card-title"> {{$evenement->est_cloturer_ou_pas}}</span>
                            </div>
                            <h5 class="card-title">{{$evenement->description}}</h5>
                            <h5 class="card-title">{{$evenement->date_evenement}}</h5>
                            <a href="{{ route('login') }}" class="btn btn-primary">Réserver</a>


                        </div>

                    </div>
                </div>
            @endforeach
        </div> 
    </div>
@endsection
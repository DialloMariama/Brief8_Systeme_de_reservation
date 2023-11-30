@extends('layouts.app')

@section('content')
@if(count($errors)>0)
<div class="alert alert-dismissible alert-danger">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    @foreach($errors->all() as $error)
    <strong>Oh snap!</strong> <a href="#" class="alert-link">{{$error}}.
        @endforeach
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Formulaire de Réservation</div>

                <div class="card-body">
                    <form method="post" action="{{ route('reservation.ajouter') }}">
                        @csrf
                        <input type="hidden" name="evenement_id" value="{{ $evenement_id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="reference">Référence</label>
                            <input type="text" class="form-control" id="reference" name="reference" required>
                        </div>

                        <div class="form-group">
                            <label for="nombre_de_place">Nombre de place</label>
                            <input type="number" class="form-control" id="nombre_de_place" name="nombre_de_place" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
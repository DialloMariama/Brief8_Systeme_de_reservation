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
    <div class="card">
        <div class="col-md-6 offset-3 mt-5">
            <h5 class="card-header text-center bg-primary text-white">Modifier Evenement</h5>
            <div class="card-body">
                <form method="post" action="/evenement/modifier" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{$evenement->id}}">
                    <div class="form-group">
                        <label for="libelle">Libellé</label>
                        <input type="text" class="form-control" id="libelle" placeholder="Enter le libellé" name="libelle" value="{{$evenement->libelle}}">
                    </div>
                    <div class="mb-3">
                    <label class="form-label mt-3">Image actuelle</label>
                    <img src="{{ asset('storage/' . $evenement->image_mise_en_avant) }}" alt="Current Image"
                        class="img-thumbnail" style="max-width: 100px;">
                </div>
                    <div class="form-group">
                        <label for="image_mise_en_avant">Image</label>
                        <input type="file" class="form-control" id="image_mise_en_avant" placeholder="Entrer l'image" >
                    </div>
                    <div class="form-group">
                        <label for="date_limite_inscription">Date limite</label>
                        <input type="datetime" class="form-control" id="date_limite_inscription" placeholder="Entrer la date limite d'inscription" name="date_limite_inscription" value="{{$evenement->date_limite_inscription}}">
                    </div>
                    <div class="form-group">
                        <label for="lieu">Lieu</label>
                        <input type="text" name="lieu" id="lieu" class="form-control" placeholder="Entrer le lieu de l'evenement" value="{{$evenement->lieu}}">
                    </div>

                    <div class="form-group">
                        <label for="est_cloturer_ou_pas">Etat</label>
                        <select name="est_cloturer_ou_pas" id="est_cloturer_ou_pas" class="form-control">
                            <option value="En_cours" @if($evenement->est_cloturer_ou_pas == 'En_cours') selected @endif>En cours</option>
                            <option value="Cloture" @if($evenement->est_cloturer_ou_pas == 'Cloture') selected @endif>Clôturé</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="date_evenement">Date de l'evenement</label>
                        <input type="datetime" class="form-control" id="date_evenement" placeholder="Entrer la date de l'evenement" name="date_evenement" value="{{$evenement->date_evenement}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Entrer la déscription" cols="10" rows="5">{{$evenement->description}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary offset-4 mt-2">Soumettre</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
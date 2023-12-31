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
<a href="/evenement/liste" class="btn btn-primary btn-sm">Liste Evenement</a>

    <div class="card">
        <div class="col-md-6 offset-3 mt-5">
            <h5 class="card-header text-center bg-primary text-white">AJOUT Evenement</h5>
            <div class="card-body">
                <form method="post" action="/evenement/ajoute" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="libelle">Libellé</label>
                        <input type="text" class="form-control" id="libelle" placeholder="Enter le libellé" name="libelle">
                    </div>
                    <div class="form-group">
                        <label for="image_mise_en_avant">Image</label>
                        <input type="file" class="form-control" id="image_mise_en_avant" placeholder="Entrer l'image" name="image_mise_en_avant">
                    </div>
                    <div class="form-group">
                        <label for="date_limite_inscription">Date limite</label>
                        <input type="datetime-local" class="form-control" id="date_limite_inscription" placeholder="Entrer la date limite d'inscription" name="date_limite_inscription">
                    </div>
                    <div class="form-group">
                        <label for="lieu">Lieu</label>
                        <input type="text" name="lieu" id="lieu" class="form-control" placeholder="Entrer le lieu de l'evenement" cols="10" rows="5">
                    </div>

                    <div class="form-group">
                        <label for="est_cloturer_ou_pas">Etat</label>
                        <select name="est_cloturer_ou_pas" id="est_cloturer_ou_pas" class="form-control">
                            <option value="En_cours">En cours</option>
                            <option value="Cloture">Clôturé</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_evenement">Date de l'evenement</label>
                        <input type="datetime-local" class="form-control" id="date_evenement" placeholder="Entrer la date de l'evenement" name="date_evenement">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Entrer la déscription" cols="10" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary offset-4 mt-2">Soumettre</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
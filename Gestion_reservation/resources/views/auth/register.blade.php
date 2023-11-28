@extends('layouts.app')

@section('content')
@if(count($errors) >0)
<div class="alert alert-dismissible alert-danger">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    @foreach($errors->all() as $error)
    {{$error}}
    <strong>OOPS!</strong>
    @endforeach
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Account Type') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control" name="role" required>
                                    <option value="" selected disabled>Choisissez le type de compte</option>
                                    <option value="association">Association</option>
                                    <option value="client">Client</option>
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nom" class="col-md-4 col-form-label text-md-end">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>

                                @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmer Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3 client-fields">

                            <div class="row mb-3">
                                <label for="prenom" class="col-md-4 col-form-label text-md-end">{{ __('Prenom') }}</label>

                                <div class="col-md-6">
                                    <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>

                                    @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="telephone" class="col-md-4 col-form-label text-md-end">{{ __('Telephone') }}</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>

                                    @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row mb-3 association-fields">
                            <div class="row mb-3">

                                <label for="slogan" class="col-md-4 col-form-label text-md-end">{{ __('Slogan') }}</label>
                                <div class="col-md-6">
                                    <input id="slogan" type="text" class="form-control @error('slogan') is-invalid @enderror" name="slogan" value="{{ old('slogan') }}" required autocomplete="slogan">
                                    @error('slogan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label for="logo" class="col-md-4 col-form-label text-md-end">{{ __('Logo') }}</label>
                                <div class="col-md-6">
                                    <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}" required autocomplete="logo">
                                    @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">

                                <label for="date_creation" class="col-md-4 col-form-label text-md-end">{{ __('Date de création') }}</label>
                                <div class="col-md-6">
                                    <input id="date_creation" type="date" class="form-control @error('date_creation') is-invalid @enderror" name="date_creation" value="{{ old('date_creation') }}" required autocomplete="date_creation">
                                    @error('date_creation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var roleSelect = document.getElementById('role');
        var associationFields = document.querySelector('.association-fields');
        var clientFields = document.querySelector('.client-fields');

        associationFields.style.display = 'none';
        clientFields.style.display = 'none';

        roleSelect.addEventListener('change', function() {
            if (roleSelect.value === 'association') {
                associationFields.style.display = 'block';
                clientFields.style.display = 'none';
            } else if (roleSelect.value === 'client') {
                associationFields.style.display = 'none';
                clientFields.style.display = 'block';
            }
        });
    });
</script>
@endsection
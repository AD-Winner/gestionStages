@extends('layouts.encadreur')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">Les infos de profil </div>

                <div class="card-body">
                <i class="text-warning"> Notez votre mot de passe quelquel part</i>
                    <form method="POST" action="{{ route('enseignant-profil-update', ['id'=>$user->id])}}">
                        @csrf
                        @method('PUT')                                                    
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Matricule :') }}</label>

                            <div class="col-md-6 ">
                                <strong>                                    
                                       {{ $enseignant->matricule}}
                                </strong>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom et Prenom') }}</label>

                            <div class="col-md-6">
                                <input id="name" disabled="disabled" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    
                         <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Informer nouveau mot de passe: ') }}</label>

                            <div class="col-md-6">
                                <input id="password"   type="password" value="" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>
                

                        

                        <div class="form-group row m-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Mettre à jour') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection

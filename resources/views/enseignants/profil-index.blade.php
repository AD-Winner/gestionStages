@extends('layouts.encadreur')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
              <!-- ALERT DE SUCCESS -->
              @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success')}}</p>
            </div>
            @endif
              <!-- ALERT DE DANGER -->
              @if(\Session::has('error'))
            <div class="alert alert-success">
                <p>{{ \Session::get('error')}}</p>
            </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Les infos de l'utilisateur</div>

                <div class="card-body">
                    
                        <div class="form-group row">

                            <div class="col-md-4 col-form-label text-md-right">
                                
                               Nom et prenom :

                            </div>
                            <div class="col-md-6">
                                <strong class="text-primary">

                                    {{ $user->name }} 
                                </strong>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-4 col-form-label text-md-right">
                                
                              E-mail :

                            </div>
                            <div class="col-md-6">
                            <strong class="text-primary">
                                    {{ $user->email }} 
                                </strong>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-4 col-form-label text-md-right">
                                
                              Profil :

                            </div>
                            <div class="col-md-6">
                            <strong class="text-primary">
                                    {{ $user->profil }} 
                                </strong>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-4 col-form-label text-md-right">
                                
                              Portable :

                            </div>
                            <div class="col-md-6">
                            <strong class="text-primary">

                                    {{ $enseignant->portable }} 
                                </strong>
                            </div>
                        </div>
                        <!-- <div class="form-group row">

                            <div class="col-md-4 col-form-label text-md-right">
                            

                                 :
            
                            </div>
                            <div class="col-md-6">
                            <strong class="text-primary">
                               
                                                        
                            </strong>
                            </div>
                            
                        </div> -->
                        <!-- <div class="form-group row">

                            <div class="col-md-4 col-form-label text-md-right">
                                
                            Niveau :
                            </div>
                            <div class="col-md-6">
                            <strong class="text-primary">

                                
                            </strong>
                            </div>

                        </div> -->
                       
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('enseignant-profil-show', ['id'=>$user->id]) }}" class="btn btn-sm btn-link mr-2"><i class="fas fa-edit"></i> {{ __('Mettre à jour mot de passe') }}</a>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection

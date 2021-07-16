@extends('layouts.template')
@section('content')
<div class="container">

    <div class="row justifu-contetent-center ml-10">
        <div class="col-sm-0 col-md-6">
            <h1>Les utilisateurs</h1>
        </div>
        <div class="col-sm-12 col-md-6">
            <form class="form-inline mt-2 mt-md-0">
                <div class="input-group mb-0 mt-0"> 
                        <input class="form-control mr-sm-0" type="text" name="p"  value="{{$p}}" placeholder="Recherche.." aria-label="Pequisar">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                        <a href="{{ route('user-index') }}" class="btn btn-outline-danger">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    


    
    <div class="row bg-white pt-3 mt-1">
        <div class="col-sm-12">
                <!-- MESSAGE DE ERREUR -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <!-- ALERT DE SUCCESS -->
            @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success')}}</p>
            </div>
            @endif
             <!-- <hr class="featurette-divider"> -->
             <!--Button Ajouter et de PDF -->
             
             <div class="col-sm-12 col-md-6">
             <div class="text-success">
                Vous êtes connecté en tanque : {{ Auth::user()->profil}}
             </div>
                Total <strong> {{ $tot }} </strong> utilisateurs,
                Adminis: <strong> {{$totalAdmin}}, </strong>
                Etudiants: <strong> {{$totalEtudiants}},</strong>
                Enseignants: <strong> {{$totalEnseignants}}</strong> 
               
               

                <div class="float-right mb-2 mt-2">
                        
                    
                        <a class="btn btn-md btn-outline-primary " href="{{route('user-create')}}"><i class="fas fa-plus"></i> Ajouter </a>                    
                         
                </div>
             </div>               
            <!-- <hr class="featurette-divider"> -->
        </div>
        <div class="col-12">
        <!--Table des données -->
            <div class="table-responsive">
                <table class="table table-striped table-sm table-hover">
                        <thead class="table-dark">
                            <tr>                              
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Profil</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>                                                 
                                <td> {{$user->id}} </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td> {{$user->profil}} </td>                                                   
                                <td class='d-flex'>
                                <a href=" {{route('user-edit',['id'=>$user->id])}} "  class="btn btn-sm btn-info mr-2"> <i class="fas fa-edit"></i></a>                                   
                                    <form action=" {{ route('user-destroy', ['id'=>$user->id])}} 
                                    "method="post" onsubmit=" return confirm('Suppression de enregistrement! Êtes-vous sûr?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button> <!--<i class="fa fa-trash"></i>-->
                                    </form>          
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
                <div class="float-right">
                        {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>



</div>

@endsection
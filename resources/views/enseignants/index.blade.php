
@extends('layouts.template')
@section('content')
<div class='container'>
    <div class="row mb-4">
            <div class="col-sm-12 col-md-6">
               <a href="{{ route('admin-accueil') }}" class="btn btn-md btn-outline-secondary float-left">  <i class="fas fa-arrow-circle-left"></i> Retour</a>
            </div>
            <div class="col-sm-12 col-md-6">
               <!-- <h1>Résultats</h1>-->
            </div>
    </div>

    <div class="row justifu-contetent-center ml-10">
        <div class="col-sm-0 col-md-6">
                <h4>{{$total}} Enseignants enregistrés</h4>
                <strong> </strong>
        </div>
        <div class="col-sm-12 col-md-6">
            <form class="form-inline mt-2 mt-md-0">
                <div class="input-group mb-0 mt-0"> 
                        <input class="form-control mr-sm-0" type="text" name="p"  value="" placeholder="Rechercher..." aria-label="Recherche">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
                        <a href="" class="btn btn-outline-danger">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
  


    <div class="row bg-white pt-3 mt-1 mb-3">
       <div class="col-sm-12">
                 <!--MESSAGE DE ERREUR -->
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
            @if(\Session::has('error'))
            <div class="alert alert-danger">
                <p>{{ \Session::get('error')}}</p>
            </div>
            @endif
            <!--Button Ajouter et de PDF -->
            
        </div>
        <hr class="featurette-divider">
        <div class="col-12 col-md-6">
                 <div class="float-right">
                        <!-- Botton de la modal d'ajout de l'enseignant-->
                         <a href="{{route('prof-create')}}" class="btn  btn-outline-success" >
                              <i class="fas fa-plus"></i> Ajouter  
                        </a>            
                 </div>
                                                     
            <!-- <hr class="featurette-divider"> -->
        </div>
    </div>
    <div class="row bg-white mt-1 mb-3">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover ">
                        <thead class="table-dark">
                            <tr>
                                <th>id</th>
                                <th>User</th>
                                <th>Matricule</th>
                                <th>Prenom</th>
                                <th>Nom</th>
                                <th>Sexe</th>
                                <th>Portable</th>
                                <th>E-mail</th>
                                <th>CP</th>
                                <th>adresse</th>                          
                                <th>Parcours</th>                          
                                <th>Actions</th>                          
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($enseignants as $prof)
                                <tr>
                                    <td>{{$prof->id}}</td>   
                                    <td>{{$prof->user_id}}</td>   
                                    <td>{{$prof->matricule}}</td>   
                                    <td>{{$prof->prenom}}</td>   
                                    <td>{{$prof->nom}}</td>   
                                    <td>{{$prof->sexe}}</td>   
                                    <td>{{$prof->portable}}</td>  
                                    <td>{{$prof->email}}</td>   
                                    <td>{{$prof->code_postal}}</td>   
                                    <td>{{$prof->adresse}}</td>   
                                    <td>{{$prof->classes->count()}}</td>   
                                     
                                     <td class='d-flex'>
                                        <a href="{{ route('prof-edit', ['id'=>$prof->id])}}" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></a>
                                        <form action=" {{ route('prof-destroy', ['id'=>$prof->id])}} 
                                        " method="post"
                                         onsubmit=" return confirm('Suppression! Êtes-vous sûr de le supprimer ?');">
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
                        {{$enseignants->links()}}
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
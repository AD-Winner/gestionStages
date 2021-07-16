<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEnseignantRequest;
use App\Http\Requests\UpdateEnseignantRequest;
use Illuminate\Support\Facades\Auth;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verif(){
        if(Auth::user()->profil !='administrateur'){
            notify()->error("Vous n'avez pas  l'autorisation");
           return redirect('stages/');
        }
    }
    public function index()
    {
        //
        if(Auth::user()->profil !='Administrateur'){
            notify()->error("Vous n'avez pas  l'autorisation");
           return redirect('stages/');
        }else{
            $enseignants = Enseignant::orderBy('id','DESC')->paginate(4);;
            $total = Enseignant::count();
            return view('enseignants.index', ['enseignants'=>$enseignants, 'total'=>$total]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // echo "kkkkk";
       $users = User::where('profil', 'Enseignant')
          ->orderBy('id', 'DESC')->get();
        return view ('enseignants.create', ['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnseignantRequest $request)
    {
        //

    
        $enseignant = new Enseignant();
        $enseignant->matricule = $request->matricule;
        $enseignant->prenom = $request->prenom;
        $enseignant->nom = $request->nom;
        $enseignant->sexe = $request->sexe;
        $enseignant->email = $request->email;
        $enseignant->code_postal = $request->code_postal;
        $enseignant->portable = $request->portable;
        $enseignant->adresse = $request->adresse;
        $enseignant->user_id = $request->user_id;
        $enseignant->save();

        return redirect(route('prof-index'))->with('success', 'Enseignant ajouter avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function show(Enseignant $enseignant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $enseignant = Enseignant::find($id);
            $users = User::where('profil', 'Enseignant')
                ->orderBy('id', 'DESC')->get();
        return view('enseignants.edit', ['enseignant'=>$enseignant, 'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnseignantRequest $request, $id)
    {
        //
        $enseignant = Enseignant::find($id);
        if($enseignant){

            $enseignant->matricule = $request->matricule;
            $enseignant->prenom = $request->prenom;
            $enseignant->nom = $request->nom;
            $enseignant->sexe = $request->sexe;
            $enseignant->email = $request->email;
            $enseignant->code_postal = $request->code_postal;
            $enseignant->portable = $request->portable;
            $enseignant->adresse = $request->adresse;
            $enseignant->user_id = $request->user_id;
            $enseignant->update();
            return redirect(route('prof-index'))->with('success', 'Mise à jour effectué avec succès.');
        }else{
            return redirect(route('prof-index'))->with('error', 'Mise à jour non effectu!');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Enseignant::find($id)->delete();
        return redirect(route('prof-index'))->with('success', 'Enregistrement supprimé avec succès.');
    }
}

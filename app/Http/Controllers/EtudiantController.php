<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Etudiant;
use App\Models\User;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $etudiants = Etudiant::orderBy('id','DESC')->paginate(10);;
        $total = Etudiant::count();
        return view('etudiants.index', ['etudiants'=>$etudiants, 'total'=>$total]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         ##-- On selectionne tous les classes pour pouvoir les afficher au select input --##
         $classes = Classe::all();
         $users = User::where('profil', 'Etudiant')
          ->orderBy('id', 'DESC')->get();
         // Puis on renvoi la vue create avec la liste des classes
         return view('etudiants.create', ['classes'=>$classes, 'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEtudiantRequest $request)
    {
        //
        $user = new User();
        $user->name=$request->prenom." ".$request->nom;
        $user->email=$request->email;
        $user->profil= 'Etudiant';
        $user->password= Hash::make($request->password);
        $user->save();

        $etudiant = new Etudiant();
        $etudiant->matricule = $request->matricule;
        $etudiant->prenom = $request->prenom;
        $etudiant->nom = $request->nom;
        $etudiant->sexe = $request->sexe;
        $etudiant->email = $request->email;
        $etudiant->code_postal = $request->code_postal;
        $etudiant->portable = $request->portable;
        $etudiant->adresse = $request->adresse;
        $etudiant->classe_id = $request->classe_id;
        $etudiant->user_id = $user->id;
        $etudiant->save();


    

        return redirect(route('etudiant-index'))->with('success', 'Les informations  ajout??es avec succ??s.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // On trouve l'etudiant par ID
        $etudiant = Etudiant::find($id);
         ##-- On selectionne tous les classes pour pouvoir recuperer la classe d'tudiant les afficher au select box --##
         $users = User::where('profil', 'Etudiant')
         ->orderBy('id', 'DESC')->get();
         $classes = Classe::all();
         // Puis on renvoi la vue edit etudiant avec la liste des classes
         return view('etudiants.edit', ['etudiant'=>$etudiant,'classes'=>$classes, 'users'=>$users]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEtudiantRequest $request, $id)
    {
        //
        $etudiant = Etudiant::find($id);
        if($etudiant){

            $etudiant->matricule = $request->matricule;
            $etudiant->prenom = $request->prenom;
            $etudiant->nom = $request->nom;
            $etudiant->sexe = $request->sexe;
            $etudiant->email = $request->email;
            $etudiant->code_postal = $request->code_postal;
            $etudiant->portable = $request->portable;
            $etudiant->adresse = $request->adresse;
            $etudiant->classe_id = $request->classe_id;
            $etudiant->user_id = $request->user_id;
            $etudiant->update();

            return redirect(route('etudiant-index'))->with('success', 'Mise ?? jour des informations effectu??e avec succ??s.');
        }elseif(!$etudiant){
            return redirect(route('etudiant-index'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Etudiant::find($id)->delete();
        return redirect(route('etudiant-index'))->with('success', 'Enregistrement supprim?? avec succ??s.');
    }
}

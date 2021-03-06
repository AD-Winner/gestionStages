<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEnseignantRequest;
use App\Http\Requests\UpdateEnseignantRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
            $enseignants = Enseignant::orderBy('id','DESC')->paginate(10);;
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

        $user = new User();
        $user->name=$request->prenom." ".$request->nom;
        $user->email=$request->email;
        $user->profil= 'Enseignant';
        $user->password= Hash::make($request->password);
        $user->save();

    
        $enseignant = new Enseignant();
        $enseignant->matricule = $request->matricule;
        $enseignant->prenom = $request->prenom;
        $enseignant->nom = $request->nom;
        $enseignant->sexe = $request->sexe;
        $enseignant->email = $request->email;
        $enseignant->code_postal = $request->code_postal;
        $enseignant->portable = $request->portable;
        $enseignant->adresse = $request->adresse;
        $enseignant->user_id = $user->id;
        $enseignant->save();

        return redirect(route('prof-index'))->with('success', 'Enseignant ajouter avec succ??s.');
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
            return redirect(route('prof-index'))->with('success', 'Mise ?? jour effectu?? avec succ??s.');
        }else{
            return redirect(route('prof-index'))->with('error', 'Mise ?? jour non effectu!');

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
        //*
        
        try {
            //code...
            Enseignant::find($id)->delete();
            return redirect(route('prof-index'))->with('success', 'Enregistrement supprim?? avec succ??s.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect(route('prof-index'))->with('error', 'Impossible terminer operation, il y a erreurs! ');
        }
        
       
    }
}

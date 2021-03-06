<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class EncadreurController extends Controller
{
    public function index(Request $req){
        $user = Auth::user();
        $enseignant = Enseignant::where('user_id','=',$user->id)->first();
        // dd($enseignant);
        if($enseignant->classes != null){
            $total_stages = 0;
        }else{
            $total_stages = Stage::where('classe_id','=',$enseignant->classes->first()->id)->count();
        }

       return view('encadreur.index',['enseignant' => $enseignant,'total_stages' => $total_stages]);
    }
    public function dashboard(){
        $user = Auth::user();
        $enseignant = Enseignant::where('user_id','=',$user->id)->first();
        //recup stages concernés 
        $stages = Stage::where('enseignant_id', '=', $enseignant->id)->paginate(3);
        return view('encadreur.dashboard',['stages' => $stages,'enseignant' => $enseignant]);
    }
    public function show(Stage $stage,$id)
    {   
        $user = Auth::user();
        $enseignant = Enseignant::where('user_id','=',$user->id)->first();
        $stage = Stage::find($id);
    //    $ens1 = DB::select('select matricule,nom,prenom from stages s,enseignants e where s.voeux_ens1 = e.id and e.id=?',[9]);
        $ens3 =Enseignant::find($stage->voeux_ens3);
        $ens2 =Enseignant::find($stage->voeux_ens2);
        $ens1 =Enseignant::find($stage->voeux_ens1);
        $encadreur = Enseignant::find($stage->enseignant_id);

        return view('encadreur.show', ['stage' => Stage::find($id),'ens1'=> $ens1, 'ens2' =>$ens2, 'ens3' => $ens3, 'encadreur'=> $encadreur,'enseignant' => $enseignant]);
    }
    public function affecter(){
        $user = Auth::user();
        $enseignant = Enseignant::where('user_id','=',$user->id)->first();
        //$stages = Stage::where('classe_id','=',$enseignant->classes->first()->id)->get();
        $stages = Stage::where('enseignant_id','=',$user->id)->get();
        // dd($stages);
        return view('encadreur.affecter',['stages' => $stages,'enseignant' => $enseignant]);
    }
    public function signer($id,Request $req){
        $user = Auth::user();
        $stage = Stage::find($id);
        $enseignant = Enseignant::where('user_id','=',$user->id)->first();
        if($req->isMethod('GET')){
            return view('encadreur.signer',['enseignant' => $enseignant,'stage' => $stage]);
        }else{
            //recup du fichier 
              //upload fichier
                $fiche = $req->file('fiche');
                $ficheName = 'Fiche-'.date("Y_m_d-H_i_s").'.'.$fiche->extension();
                $fiche->move(\public_path('Fiches_Stages'),$ficheName);
                //supp de l'ancienne fiche
                if( $stage->fiche != null ){
                $fiche =public_path('Fiches_Stages/'.Stage::find($id)->fiche);
                unlink($fiche);    
                } 
                //signature du fichier 
                $stage->signe=true;
                $stage->fiche = $ficheName;
                $stage->save();
                //
                notify()->success('la signature a été effectuée avec succès','Signature');
                return redirect(route('encadreur-affecter'));
        }
    }
}

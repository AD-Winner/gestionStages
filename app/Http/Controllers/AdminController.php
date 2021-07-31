<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Stage;
use App\Models\User;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Etudiant;


class AdminController extends Controller
{
    //

    public function __construct()
    {
        
        $this->middleware('auth');

        //$this->middleware(['profil:administrateur']);
    }


    public function affecter($id){
        $enseignants = Enseignant::all();
        $stage = Stage::find($id);
        $voeu3 =Enseignant::find($stage->voeux_ens3);
        $voeu2 =Enseignant::find($stage->voeux_ens2);
        $voeu1 =Enseignant::find($stage->voeux_ens1);
        return view('pages.affecter',
                    ['enseignants'=>$enseignants,
                    'id_stage' => $id,'stage' => $stage,'voeu1' => $voeu1,'voeu2' => $voeu2,'voeu3' => $voeu3]);
    }

    public function affectere(Request $request){
        //affectation de l'encadreur
        $stage = Stage::find($request->id_stage);
        $stage->enseignant_id=$request->choix;
        $stage->save();
        notify()->success('Affectation encadreur reussie','Affectation');
        return redirect(route('page-stage'));
    }



    public function dashboard(){
        return view ('admin.dashboard');
    }
    public function home(){
        return view ('admin.home');
    }

    
    public function index(){
        return view('layouts.admin');
    }
    public function login(){
        return view('pages.login');
    }
    public function profil(){
        return view('pages.profil');
    }
    public function contact(){
        return view('pages.contact');
    }
    public function stage(){
        $stages = Stage::orderBy('id','DESC')->paginate(4);;
        $total = Stage::count();
        return view('pages.stage',['stages'=>$stages, 'total'=>$total]);
        // return view('pages.Stage');
    }
    public function depot(){
        return view('pages.depot');
    }
    public function homeEtudiant(){
        $user = Auth::user();
        // $etudiant = User::where('user_id','=',$user->id)->first();
        $etudiant = Etudiant::where('user_id','=',$user->id)->first();
        return view('pages.accueilEtudiant', ['etudiant'=>$etudiant, 'user'=>$user]);
    }
    public function homeAdmin(){
        $total_ens = Enseignant::count();
        $total_etu = Etudiant::count();
        $total_sta = Stage::count();
        $total_par = Classe::count();
        return view('pages.accueilAdmin', 
        ['total_ens' => $total_ens,'total_etu' => $total_etu,'total_sta' => $total_sta,'total_par' => $total_par]);
    }
    public function homeResponsable(){
        return view('pages.accueilResponsable');
    }
    public function telechargement(){
        return view('pages.telechargement');
    }
    public function etudiantsEncadres(){
        return view('responsable.mesEtudiants');
    }
}

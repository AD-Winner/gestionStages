<?php


namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDF;


class UserController extends Controller
{
    //

    
    public function __construct(){
        $this->middleware('auth');
       // $this->middleware(['user']);
    }

    

    public function index(Request $request){
        $p ="";
        $tot = User::count();
        $totalAdmin = User::where('profil','Administrateur')->count();
        $totalEtudiants = User::where('profil','Etudiant')->count();
        $totalEnseignants = User::where('profil','Enseignant')->count();
        $users = User::orderBy('id','DESC')->paginate(10);
        return view('users.index', ['users'=>$users, 'p'=>$p,
        'tot'=>$tot,
        'totalAdmin'=>$totalAdmin,
        'totalEnseignants'=>$totalEnseignants,
        'totalEtudiants'=>$totalEtudiants
    ]);
    }

    public function create(){
        return view('users.create', ['']
    );
    }

    public function edit($id){
        $user = User::find($id);
        if(!empty($user)){

            return view('users.edit', [
                'user'=>$user,
            ]);
        }else{
            return redirect(route('users-index'));
        }
    }
     public function profilEtudiant($id){
        $user = User::find($id);
        $etudiant = Etudiant::where('user_id', '=',$id)->first();
        // dd($etudiant);
        if(!empty($user)){

            return view('etudiants.profil-index', [
                'user'=>$user,
                'etudiant'=>$etudiant,
            ]);
        }else{
            return redirect(route('users-index'));
        }
    }
     public function profilShow($id){
        $user = User::find($id);
        $etudiant = Etudiant::where('user_id', '=',$id)->first();
        // dd($etudiant);
        if(!empty($user)){

            return view('etudiants.profil-update', [
                'user'=>$user,
                'etudiant'=>$etudiant,
            ]);
        }
    }
     public function profilUpdate(Request $request, $id){
        $user = User::find($id);
       // $etudiant = Etudiant::where('user_id', '=',$id)->first();
       if($user){
            
            $user->password= Hash::make($request->password);
            $user->update();
            return redirect(route('etudiant-profil', ['id'=>$user->id]))->with('success', 'Mise à jour effectué.');
            
        }else{
            return redirect(route('etudiant-profil'))->with('error', 'Mise à jour non effectué.');
        }
    }
     public function profilEnseignant($id){
        $user = User::find($id);
        $enseignant = Enseignant::where('user_id', '=',$id)->first();
       //  dd($enseignant);
        if(!empty($user)){

            return view('enseignants.profil-index', [
                'user'=>$user,
                'enseignant'=>$enseignant,
            ]);
        }
        
    }
     public function profilShowEnseignant($id){
        $user = User::find($id);
        $enseignant = Enseignant::where('user_id', '=',$id)->first();
        // dd($etudiant);
        if(!empty($user)){

            return view('enseignants.profil-update', [
                'user'=>$user,
                'enseignant'=>$enseignant,
            ]);
        }
    }
     public function profilUpdateEnseignant(Request $request, $id){
        $user = User::find($id);
       // $etudiant = Etudiant::where('user_id', '=',$id)->first();
       if($user){
            
            $user->password= Hash::make($request->password);
            $user->update();
            return redirect(route('enseignant-profil', ['id'=>$user->id]))->with('success', 'Mise à jour effectué.');
            
        }else{
            return redirect(route('enseignant-profil'))->with('error', 'Mise à jour non effectué.');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'profil' => ['string', 'min:3'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
        /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function store(Request $request)
    {
            $user = new User();

            $user->name=$request->name;
            $user->email=$request->email;
            $user->profil=$request->profil;
            $user->password= Hash::make($request->password);
            $user->save();
            
            return redirect(route('user-index'))->with('success', 'Utilisateur ajouté.');
    }
    public function update(Request $request, $id)
    {
        //dd($request);
        $user = User::find($id);
        if(empty($user)){
            return redirect(route('user-index'));
        }
        if($user){
            
            $user->name=$request->name;
            $user->email=$request->email;
            $user->profil=$request->profil;
            $user->password= Hash::make($request->password);
            $user->update();
            return redirect(route('user-index'))->with('success', 'Mise à jour effectué.');
            
        }

        
    }
    protected function destroy($id)
    {
        //dd($id);
        try {
            //code...
            User::find($id)->delete();
            return redirect(route('user-index'))->with('success', 'Données suppriméss.');
        }catch(Exception $e){
            console.log('Erreur: '.$e);
        }
     
    }
    
   

}

<?php

namespace App\Http\Controllers;
use App\Models\Region;
use App\Models\Cercle;
use App\Models\Secteur;
use App\Models\District;
use App\Models\Bureau;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function ajax()
    {
        $region = Region::all();
        return view('index', ['region'=>$region]);
    }
    public function findCercleName (Request $request){
        $data=Cercle::select('cercle','id')
            ->where('region_id', $request->id)->take(100)->get();
            return response()->json($data);
    }
   
   
    public function save(request $request)
    {
        dd($request);
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $values = [
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>$request->password,
            ];

            $query = DB::table('students')->insert($values);

            if($query){
                return response()->json(['status'=>1, 'msg'=>'New student has been successfully registered']);   
            }
        }
        //return view('index');
    }
    public function userIndex()
    {
        
        return view('users.home');
    }
    public function adminIndex()
    {
        return view('admin.home');
    }

    //Função para gerar PDF
  public function geraPdf(){
      $clientes = Cliente::all();
      $pdf = PDF::loadView('pdf', ['clientes'=>$clientes]);
      return $pdf->setPaper('a4')->stream('clientes.pdf');

  }

}

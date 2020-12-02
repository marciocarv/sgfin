<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use App\Models\Ordinance;

class SchoolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        
    }

    public function create(Request $request){
        $javascript = true;
        $validate = [
            ['campo'=>'cnpj','value'=>'99.999.999/9999-99', 'mask'=>'maskPattern'],
            ['campo'=>'cep','value'=>'99.999-999', 'mask'=>'maskPattern'],
            ['campo'=>'telefone','value'=>'(99) 9999-9999', 'mask'=>'maskPattern']
        ];
        if($request->input('name') == null || $request->input('cnpj') == null){
            return view('formSchool', ['javascript'=>$javascript, 'script'=>'validate', 'route'=>'addOrdinance', 'action'=>'create', 'validate'=>$validate]);
        }else{
            
            $school = new School;
            $school->name = $request->name;
            $school->associacao = $request->associacao;
            $school->codigo_inep = $request->codigo_inep;
            $school->email = $request->email;
            $school->telefone = $request->telefone;
            $school->presidente = $request->presidente;
            $school->secretario = $request->secretario;
            $school->caf = $request->caf;
            $school->modulo = $request->modulo;
            $school->cnpj = $request->cnpj;
            $school->adress = $request->adress;
            $school->cep = $request->cep;
            $school->lei_criacao = $request->lei_criacao;
            $school->date_criacao = $request->date_criacao;
            $school->autorizacao_funcionamento = $request->autorizacao_funcionamento;

            if($request->image_lei){
                $image_lei = $request->image_lei->store('images');
                $ordinance->image_lei = $image_lei;
            }

            if($school->save()){
                $tenancyC = new TenancyController();
                $ordinance = new Ordinance;
                $ordinance->school_id = $school->id;
                $ordinance->description = 'Recurso sem Portaria';
                $ordinance->save();
                if($tenancyC->create($school->id, Auth::id())){
                    return redirect()->route('dashboard');
                }                
            }else{
                return view('formSchool', ['msg'=>'Não foi possível salvar sua mensagem!']);
            }
        }
        
    }

    public function update(){
        
    }

    public function delete(){
        
    }
}

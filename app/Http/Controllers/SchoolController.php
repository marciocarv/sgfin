<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Ace;
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
        if($request->input('name') == null || $request->input('cnpj') == null){
            return view('formSchool', ['javascript'=>false, 'route'=>'addSchool', 'action'=>'create']);
        }else{
            
            $school = new School;
            $school->name = $request->name;
            $school->codigo_inep = $request->codigo_inep;
            $school->email = $request->email;
            $school->telefone = $request->telefone;
            $school->diretor = $request->diretor;
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
                $ordinance->number = '0';
                $ordinance->save();
                $ordinance2 = new Ordinance;
                $ordinance2->description = 'Devolução de Valores';
                $ordinance2->number = '1';
                $ordinance2->save();
                $ace = new Ace();
                $ace->school_id = $school->id;
                $ace->presidente = $school->diretor;
                $ace->secretario = $school->secretario;
                $ace->save();
                if($tenancyC->create($school->id, Auth::id(), 'FINANCEIRO')){
                    return redirect()->route('dashboard');
                }                
            }else{
                return view('formSchool', ['msg'=>'Não foi possível salvar sua escola!']);
            }
        }
        
    }

    public function setUpdate($id){
        $school = School::find($id);

        if($school->id === session('school')->id){
            return view('formSchool', ['school'=>$school, 'action'=>'update', 'route'=>'upSchoolPost']);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function update(Request $request){
        $school = School::find($request->id);

        $school->name = $request->name;
        $school->codigo_inep = $request->codigo_inep;
        $school->email = $request->email;
        $school->telefone = $request->telefone;
        $school->diretor = $request->diretor;
        $school->secretario = $request->secretario;
        $school->caf = $request->caf;
        $school->modulo = $request->modulo;
        $school->cnpj = $request->cnpj;
        $school->adress = $request->adress;
        $school->cep = $request->cep;
        $school->lei_criacao = $request->lei_criacao;
        $school->date_criacao = $request->date_criacao;
        $school->autorizacao_funcionamento = $request->autorizacao_funcionamento;

        $ace = Ace::find($school->ace->id);
        $ace->presidente = $school->diretor;
        $ace->secretario = $school->secretario;

        $school->save();
        $ace->save();

        return redirect()->route('profile')->with('msg', 'Escola Editada com sucesso');
    }

    public function delete(){
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

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
            return view('formSchool');
        }else{
            
            $school = new School;
            $school->name = $request->name;
            $school->cnpj = $request->cnpj;
            $school->adress = $request->adress;
            $school->cep = $request->cep;
            $school->lei_criacao = $request->lei_criacao;

            $image_lei = $request->image_lei->store('images');

            $school->image_lei = $image_lei;

            if($school->save()){
                $tenancyC = new TenancyController();
                if($tenancyC->create($school->id, Auth::id())){
                    return view('dashboard', ['msg'=>'Escola Salva com sucesso!']);
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

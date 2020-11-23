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
        $javascript = true;
        $validate = [
            ['campo'=>'cnpj','value'=>'99.999.999/0009-99', 'mask'=>'maskPattern'],
            ['campo'=>'cep','value'=>'99.999-999', 'mask'=>'maskPattern'],
        ];
        if($request->input('name') == null || $request->input('cnpj') == null){
            return view('formSchool', ['javascript'=>$javascript, 'route'=>'addOrdinance', 'action'=>'create', 'validate'=>$validate]);
        }else{
            
            $school = new School;
            $school->name = $request->name;
            $school->cnpj = $request->cnpj;
            $school->adress = $request->adress;
            $school->cep = $request->cep;
            $school->lei_criacao = $request->lei_criacao;

            if($request->image_lei){
                $image_lei = $request->image_lei->store('images');
                $ordinance->image_lei = $image_lei;
            }

            if($school->save()){
                $tenancyC = new TenancyController();
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

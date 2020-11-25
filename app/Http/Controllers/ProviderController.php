<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $school = session('school');
        $provider =  new Provider;

        $providers = $provider->providerBySchool($school->id);

        return view('provider', ['providers'=>$providers, 'acesso'=>true]);
    }

    public function setCreate(){
        $javascript = true;
        $validate = [
            ['campo'=>'cnpj','value'=>'99.999.999/9999-99', 'mask'=>'maskPattern'],
            ['campo'=>'cpf','value'=>'999.999.999-99', 'mask'=>'maskPattern'],
            ['campo'=>'phone','value'=>'(99) 99999-9999', 'mask'=>'maskPattern']
        ];

        return view('formProvider', ['javascript'=>$javascript, 'route'=>'addProviderPost', 'action'=>'create', 'validate'=>$validate]);
    }

    public function create(Request $request){
            //montagem do objeto ordinance para inserir
            $school = session('school');
            $provider = new Provider;
            $provider->school_id = $school->id;
            $provider->name = $request->name;
            $provider->company_name = $request->company_name;
            $provider->cpf = $request->cpf;
            $provider->cnpj = $request->cnpj;
            $provider->phone = $request->phone;
            $provider->adress = $request->adress;
            $provider->person_type = $request->person_type;

            if($provider->save()){
                return redirect('provider')->with('msg', 'Fornecedor Salvo com sucesso!');                
            }else{
                return redirect('provider/add')->with('msg', 'Não foi possível Salvar o registro!');
            }
    }
}

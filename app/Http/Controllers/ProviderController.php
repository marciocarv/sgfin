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

        return view('formProvider', ['route'=>'addProviderPost', 'action'=>'create']);
    }

    public function create(Request $request){
            //montagem do objeto ordinance para inserir

            if($request->person_type === 'Física'){
                $cnpj = '';
                $company_name = '';
                $cpf = $request->cpf;
            }else{
                $cnpj = $request->cnpj;
                $company_name = $request->company_name;
                $cpf = '';
            }

            $school = session('school');
            $provider = new Provider;
            $provider->school_id = $school->id;
            $provider->name = $request->name;
            $provider->company_name = $company_name;
            $provider->cpf = $cpf;
            $provider->cnpj = $cnpj;
            $provider->phone = $request->phone;
            $provider->adress = $request->adress;
            $provider->person_type = $request->person_type;

            if($provider->save()){
                return redirect('provider')->with('msg', 'Fornecedor Salvo com sucesso!');                
            }else{
                return redirect('provider/add')->with('msg', 'Não foi possível Salvar o registro!');
            }
    }

    public function delete($id){
        $provider = Provider::find($id);
        if($provider->school_id === session('school')->id){
            $provider->delete();
            return redirect('provider')->with('msg', 'Fornecedor Excluído com sucesso!');
        }else{
            return redirect('provider')->with('msg', 'Você não tem acesso a esse Fornecedor!');
        }
    }

    public function setUpdate($id){
        
        $provider = Provider::find($id);
        if($provider->school_id === session('school')->id){
            return view('formProvider', ['provider'=>$provider, 'route'=>'upProviderPost', 'action'=>'update']);
        }else{
            return redirect('provider')->with('msg', 'Você não tem acesso a esse Fornecedor!');
        }
    }

    public function update(Request $request){
        if($request->person_type === 'Física'){
            $cnpj = '';
            $company_name = '';
            $cpf = $request->cpf;
        }else{
            $cnpj = $request->cnpj;
            $company_name = $request->company_name;
            $cpf = '';
        }

        $provider = Provider::find($request->id);

        $provider->name = $request->name;
        $provider->company_name = $company_name;
        $provider->cpf = $cpf;
        $provider->cnpj = $cnpj;
        $provider->phone = $request->phone;
        $provider->adress = $request->adress;
        $provider->person_type = $request->person_type;

        if($provider->save()){
            return redirect('provider')->with('msg', 'Fornecedor atualizado com sucesso!');                
        }else{
            return redirect('provider')->with('msg', 'Não foi possível atualizar o fornecedor!');
        }
    }

    public function detail($id){
        $provider = Provider::find($id);

        if($provider->school_id === session('school')->id){
            $expenditures = $provider->expenditures;

            $pendingExpenditures = $provider->pendingExpenditures($id);

            $expendituresPaid = $provider->expendituresPaid($id);

            return view('detailProvider', ['provider'=>$provider, 'acesso'=>true, 'pendingExpenditures'=>$pendingExpenditures, 'expendituresPaid'=>$expendituresPaid]);
        }else{
            return view('detailProvider', ['acesso'=>false]);
        }
    }
}

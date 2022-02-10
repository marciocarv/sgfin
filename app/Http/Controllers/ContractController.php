<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\School;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    public function show(Request $request){

        if(!$request->year){
            $data_inicio = mktime(0, 0, 0, 1 , 1 , date('Y'));
            $data_fim = mktime(23, 59, 59, 12, 31, date('Y'));
    
            $dataInicial = date('Y-m-d',$data_inicio);
            $dataFinal = date('Y-m-d',$data_fim);

            $year = date('Y');
        }else{
            $data_inicio = mktime(0, 0, 0, 1 , 1 , $request->year);
            $data_fim = mktime(23, 59, 59, 12, 31, $request->year);
    
            $dataInicial = date('Y-m-d',$data_inicio);
            $dataFinal = date('Y-m-d',$data_fim);

            $year = $request->year;
        }

        $school = School::find(session('school')->id);

        $contracts = $school->contracts($dataInicial, $dataFinal);

        return view('contract.contract', ['contracts'=>$contracts, 'year'=>$year]);
    }

    public function setCreate(){
        $school = School::find(session('school')->id);

        $providers = $school->providers;

        return view('contract.formContract', ['route'=>'addContract', 'action'=>'create', 'providers'=>$providers]);
    }

    public function create(Request $request){

        $value = Str::of($request->value)->replace('.', '');
        $value = Str::of($value)->replace(',', '.');

        $contract = new Contract;
        $contract->school_id = session('school')->id;
        $contract->provider_id = $request->provider_id;
        $contract->start_period = $request->start_period;
        $contract->end_period = $request->end_period;
        $contract->num_contract = $request->num_contract;
        $contract->category = $request->category;
        $contract->description = $request->description;
        $contract->object = $request->object;
        $contract->value = $value;
        $contract->nature = $request->nature;

        if($contract->save()){
            return redirect()->route('contract')->with('msg', 'Contrato Salva com sucesso!');                
        }else{
            return redirect()->route('contract')->with('msg', 'Não foi possível salvar o contrato!');
        }
    }

    public function manage($id){
        $contract = Contract::find($id);

        $items = $contract->items;

        $orders = $contract->orders;

        if($contract->category == "M"){
            $title_items = "Produtos";
            $title_orders = "Pedidos";
        }elseif($contract->category == "A"){
            $title_items = "Alimentos";
            $title_orders = "Pedidos";
        }elseif($contract->category == "P"){
            $title_items = "Serviços";
            $title_orders = "Ordem de Serviços";
        }else{
            $title_items = "Obras";
            $title_orders = "Ordem de Serviços";
        }

        if($contract->school->id === session('school')->id){
            return view('contract.manageContract', ['acesso'=>true, 'contract'=>$contract, 'items'=>$items, 'orders'=>$orders, 'title_items'=>$title_items, 'title_orders'=>$title_orders]);
        }else{
            return redirect()->route('contract')->with('msg', 'Você não tem acesso a esse contrato!');
        }

    }

}

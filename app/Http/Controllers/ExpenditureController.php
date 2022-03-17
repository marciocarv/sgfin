<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenditure;
use App\Models\FixedExpenditure;
use App\Models\Account;
use App\Models\School;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ExpenditureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    

    public function show($id, Request $request){
        $school = session('school');

        $account = Account::find($id);

        //se a data inicial e a data final vierem vazias, as datas padrão os três ultimos meses
        if(!$request->dataInicial || !$request->dataFinal){
            $data_inicio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
            $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));

            $data_base_inicial = date('Y-m-d', $data_inicio);
            $dataInicial = date("Y-m-d",strtotime(date("Y-m-d",strtotime($data_base_inicial))."-12 month"));
            $dataFinal = date('Y-m-d',$data_fim);
        }else{
            $dataInicial = $request->dataInicial;
            $dataFinal = $request->dataFinal;
        }

        if($account->school_id === $school->id){
            $expenditure =  new Expenditure;

            $expenditures = $expenditure->expenditureByAccount($account->id, $dataInicial, $dataFinal);

            return view('expenditure.expenditure', ['expenditures'=>$expenditures,
                                                    'acesso'=>true,
                                                    'account'=>$account,
                                                    'dataInicial'=>$dataInicial,
                                                    'dataFinal'=>$dataFinal
            ]);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function setCreate($id){
        $account = Account::find($id);

        $school = School::find(session('school')->id);

        //busca todas as Fornecedores para montar o select
        $options = $school->providers;

        //verifica se o usuário tem acesso a conta.
        if($account->school_id === $school->id && !$options->isEmpty()){
            return view('expenditure.formExpenditure', ['route'=>'addExpenditurePost', 'action'=>'create', 'account'=>$account, 'options'=>$options]);
        }else if($options->isEmpty()){
            return redirect()->route('provider')->with('msg', 'Você não possui fornecedores, antes de cadastrar uma Despesa, cadastre o Fornecedor do produto/serviço');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function create(Request $request){

        $request->validate([
            'description'=>'required',
            'date_expenditure'=>'required|date_format:Y-m-d',
            'value'=>'required',
            'nature'=>'required',
            'expiration'=>'required|date_format:Y-m-d'
        ]);

        $value = Str::of($request->value)->replace('.', '');
        $value = Str::of($value)->replace(',', '.');

        $expenditure = new Expenditure;

        $expenditure->account_id = $request->account_id;
        $expenditure->provider_id = $request->provider_id;
        $expenditure->description = $request->description;
        $expenditure->date_expenditure = $request->date_expenditure;
        $expenditure->value = $value;
        $expenditure->nature = $request->nature;
        $expenditure->expiration = $request->expiration;

        if($request->fixed === 'true'){
            $expenditure->fixed = true;
            $fixed = new FixedExpenditure;
            $fixed->school_id = session('school')->id;
            $fixed->account_id = $expenditure->account_id;
            $fixed->provider_id = $expenditure->provider_id;
            $fixed->description = $expenditure->description;
            $fixed->value = $expenditure->value;
            $fixed->nature = $expenditure->nature;
            $fixed->emission_date = date('Y-m-d', strtotime('+1 month', strtotime($expenditure->date_expenditure)));
            $fixed->expiration_date =date('Y-m-d', strtotime('+1 month', strtotime($expenditure->expiration)));
            $fixed->reference_month = date('m', strtotime($expenditure->date_expenditure));
            $fixed->save();
        }else{
            $expenditure->fixed = false;
        }

        if($expenditure->save()){
            return redirect()->route('expenditure',['id'=>$expenditure->account_id])->with('msg', 'Despesa Salva com sucesso!');                
        }else{
            return redirect()->route('income',['id'=>$expenditure->account_id])->with('msg', 'Não foi possível Salvar a despesa!');
        }
        
    }

    public function setUpdate($id){
        $expenditure = Expenditure::find($id);
        $school = School::find(session('school')->id);

        //busca todas as ordinances para montar o select
        $options = $school->providers;

        $account = $expenditure->account;

        if($account->school_id === session('school')->id){
            return view('expenditure.formExpenditure', ['expenditure'=>$expenditure, 'route'=>'upExpenditurePost', 'action'=>'update', 'account'=>$account, 'options'=>$options]);
        }else{
            return redirect()->route('expenditure',['id'=>$expenditure->account_id])->with('msg', 'Você não tem acesso a essa Despesa!');
        }
    }

    public function update(Request $request){

        $request->validate([
            'description'=>'required',
            'date_expenditure'=>'required|date_format:Y-m-d',
            'value'=>'required',
            'nature'=>'required',
            'expiration'=>'required|date_format:Y-m-d'
        ]);

        $expenditure = Expenditure::find($request->id);

        $account = Account::find($request->account_id);

        $value = Str::of($request->value)->replace('.', '');
        $value = Str::of($value)->replace(',', '.');

        $expenditure->account_id = $account->id;
        $expenditure->provider_id = $request->provider_id;
        $expenditure->description = $request->description;
        $expenditure->date_expenditure = $request->date_expenditure;
        $expenditure->value = $value;
        $expenditure->nature = $request->nature;
        $expenditure->expiration = $request->expiration;

        if($expenditure->fixed){
            if($request->fixed === 'true'){
                $expenditure->fixed = true;
            }else{
                $expenditure->fixed = false;
            }
        }else{
            if($request->fixed === 'true'){
                $expenditure->fixed = true;
                $fixed = new FixedExpenditure;
                $fixed->school_id = session('school')->id;
                $fixed->account_id = $expenditure->account_id;
                $fixed->provider_id = $expenditure->provider_id;
                $fixed->description = $expenditure->description;
                $fixed->value = $expenditure->value;
                $fixed->nature = $expenditure->nature;
                $fixed->emission_date = date('Y-m-d', strtotime('+1 month', strtotime($expenditure->date_expenditure)));
                $fixed->expiration_date =date('Y-m-d', strtotime('+1 month', strtotime($expenditure->expiration)));
                $fixed->reference_month = date('m', strtotime($expenditure->date_expenditure));
                $fixed->save();
            }else{
                $expenditure->fixed = false;
            }
        }

        if($expenditure->save()){
            return redirect()->route('expenditure',['id'=>$expenditure->account_id])->with('msg', 'Despesa alterada com sucesso!');                
        }else{
            return redirect()->route('expenditure',['id'=>$expenditure->account_id])->with('msg', 'Não foi possível alterar a despesa!');
        }
    }
    public function delete($id){
        $expenditure = Expenditure::find($id);
        $account = $expenditure->account;

        if($account->school_id === session('school')->id){
            $expenditure->delete();
            return redirect()->route('expenditure', ['id'=>$account->id])->with('msg', 'Despesa Excluída com sucesso!');
        }else{
            return redirect()->route('expenditure', ['id'=>$account->id])->with('msg', 'Você não tem acesso a essa Despesa!');
        }
    }

    public function detail($id){
        $expenditure = Expenditure::find($id);

        $valorTotal = '';

        if($expenditure->pay){
            $expenditure->pay->date_pay = Carbon::parse($expenditure->pay->date_pay);
            $expenditure->pay->emission_invoice = Carbon::parse($expenditure->pay->emission_invoice);
        }

        if($expenditure->account->school_id === session('school')->id){
            
            return view('expenditure.detailExpenditure', ['expenditure'=>$expenditure, 'acesso'=>true]);
        }else{
            return view('expenditure.detailExpenditure', ['acesso'=>false]);
        }
    }

    public function GerExpenditureByOrder(Request $request){
        $expenditure = new Expenditure;

        $value = Str::of($request->value)->replace('.', '');
        $value = Str::of($value)->replace(',', '.');

        $expenditure->account_id = $request->account_id;
        $expenditure->provider_id = $request->provider_id;
        $expenditure->description = $request->description;
        $expenditure->date_expenditure = $request->date_expenditure;
        $expenditure->value = $value;
        $expenditure->nature = $request->nature;
        $expenditure->expiration = $request->expiration;
        $expenditure->fixed = false;

        if(!$expenditure->save()){
            return redirect()->route('expenditure', ['id'=>$expenditure->account_id])->with('msg', 'Não foi possível gerar sua despesa!');
        }else{
            foreach($request->id_orders as $id_order){
                $orderController = new OrderController;
    
                $orderController->updateStatus($id_order, $expenditure->id);
            }
            return redirect()->route('expenditure', ['id'=>$expenditure->account_id])->with('msg', 'Despesa Gerada com sucesso!');
        }
    }
}



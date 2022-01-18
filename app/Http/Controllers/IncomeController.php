<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Account;
use App\Models\School;
use Illuminate\Support\Str;

class IncomeController extends Controller
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
            $dataInicial = date("Y-m-d",strtotime(date("Y-m-d",strtotime($data_base_inicial))."-3 month"));
            $dataFinal = date('Y-m-d',$data_fim);
        }else{
            $dataInicial = $request->dataInicial;
            $dataFinal = $request->dataFinal;
        }

        if($account->school_id === $school->id){
            $income =  new Income;

            $incomes = $income->incomeByAccount($account->id, $dataInicial, $dataFinal);

            return view('income.income', ['incomes'=>$incomes, 
                                        'acesso'=>true, 
                                        'account'=>$account,
                                        'dataInicial'=>$dataInicial,
                                        'dataFinal'=>$dataFinal]);
        }else{
            return redirect('dashboard');
        }
    }

    public function setCreate($id){
        $account = Account::find($id);
        
        $school = School::find(session('school')->id);

        //busca todas as ordinances para montar o select
        $options = $school->ordinances;


        //verifica se o usuário tem acesso a conta.
        if($account->school_id === $school->id){
            return view('income.formIncome', ['route'=>'addIncomePost', 'action'=>'create', 'account'=>$account, 'options'=>$options]);
        }else{
            return redirect('dashboard');
        }
    }

    public function create(Request $request){

        $request->validate([
            'date_income'=>'required|date_format:Y-m-d',
            'description'=>'required',
            'value_custeio'=>'required',
            'value_capital'=>'required',
            'amount'=>'required'
        ]);

        $amount = Str::of($request->amount)->replace('.', '');
        $amount = Str::of($amount)->replace(',', '.');
        $value_custeio = Str::of($request->value_custeio)->replace('.', '');
        $value_custeio = Str::of($value_custeio)->replace(',', '.');
        $value_capital = Str::of($request->value_capital)->replace('.', '');
        $value_capital = Str::of($value_capital)->replace(',', '.');

        $income = new Income;

        $income->date_income = $request->date_income;
        $income->account_id = $request->account_id;
        $income->ordinance_id = $request->ordinance_id;
        $income->description = $request->description;
        $income->value_custeio = $value_custeio;
        $income->value_capital = $value_capital;
        $income->amount = $amount;

        if($income->save()){
            return redirect()->route('income',['id'=>$income->account_id])->with('msg', 'Receita Salva com sucesso!');                
        }else{
            return redirect()->route('income',['id'=>$income->account_id])->with('msg', 'Não foi possível Salvar a receita!');
        }
        
    }

    public function setUpdate($id){

        $income = Income::find($id);
        $school = School::find(session('school')->id);

        //busca todas as ordinances para montar o select
        $options = $school->ordinances;

        $account = $income->account;
        if($account->school_id === session('school')->id){
            return view('income.formIncome', ['income'=>$income, 'route'=>'upIncomePost', 'action'=>'update', 'account'=>$account, 'options'=>$options]);
        }else{
            return redirect()->route('income',['id'=>$income->account_id])->with('msg', 'Você não tem acesso a essa Receita!');
        }
    }

    public function update(Request $request){
        $income = Income::find($request->id);

        //$account = Account::find($request->account_id);

        $amount = Str::of($request->amount)->replace('.', '');
        $amount = Str::of($amount)->replace(',', '.');
        $value_custeio = Str::of($request->value_custeio)->replace('.', '');
        $value_custeio = Str::of($value_custeio)->replace(',', '.');
        $value_capital = Str::of($request->value_capital)->replace('.', '');
        $value_capital = Str::of($value_capital)->replace(',', '.');

        $income->date_income = $request->date_income;
        $income->account_id = $request->account_id;
        $income->ordinance_id = $request->ordinance_id;
        $income->description = $request->description;
        $income->value_custeio = $value_custeio;
        $income->value_capital = $value_capital;
        $income->amount = $amount;

        if($income->save()){
            return redirect()->route('income',['id'=>$income->account_id])->with('msg', 'Receita editada com sucesso!');                
        }else{
            return redirect()->route('income',['id'=>$income->account_id])->with('msg', 'Não foi possível Editar a receita!');
        }
    }

    public function delete($id){
        $income = Income::find($id);
        $account = $income->account;

        if($account->school_id === session('school')->id){
            $income->delete();
            return redirect()->route('income', ['id'=>$account->id])->with('msg', 'Receita Excluída com sucesso!');
        }else{
            return redirect()->route('income', ['id'=>$account->id])->with('msg', 'Você não tem acesso a essa Receita!');
        }
    }
}

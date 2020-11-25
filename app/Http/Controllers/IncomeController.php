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

    public function show($id){
        $school = session('school');

        $account = Account::find($id);

        if($account->school_id === $school->id){
            $income =  new Income;

            $incomes = $income->incomeByAccount($account->id);

            return view('income', ['incomes'=>$incomes, 'acesso'=>true, 'account'=>$account]);
        }else{
            return redirect('dashboard');
        }
    }

    public function setCreate($id){
        $account = Account::find($id);
        $javascript = true;
        $validate = [
            ['campo'=>'amount','value'=>'', 'mask'=>'maskMoney'],
            ['campo'=>'value_capital','value'=>'', 'mask'=>'maskMoney'],
            ['campo'=>'value_custeio','value'=>'', 'mask'=>'maskMoney']
        ];

        $school = School::find(session('school')->id);

        //busca todas as ordinances para montar o select
        $options = $school->ordinances;

        //verifica se o usuário tem acesso a conta.
        if($account->school_id === $school->id){
            return view('formIncome', ['javascript'=>$javascript, 'route'=>'addIncomePost', 'action'=>'create', 'account'=>$account, 'options'=>$options, 'validate'=>$validate]);
        }else{
            return redirect('dashoboard');
        }
    }

    public function create(Request $request){

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
        $javascript = true;
        $validate = [
            ['campo'=>'amount','value'=>'', 'mask'=>'maskMoney'],
            ['campo'=>'value_capital','value'=>'', 'mask'=>'maskMoney'],
            ['campo'=>'value_custeio','value'=>'', 'mask'=>'maskMoney']
        ];
        $income = Income::find($id);
        $school = School::find(session('school')->id);

        //busca todas as ordinances para montar o select
        $options = $school->ordinances;

        $account = $income->account;
        if($account->school_id === session('school')->id){
            return view('formIncome', ['javascript'=>$javascript, 'income'=>$income, 'route'=>'upIncomePost', 'action'=>'update', 'account'=>$account, 'options'=>$options, 'validate'=>$validate]);
        }else{
            return redirect()->route('income',['id'=>$income->account_id])->with('msg', 'Você não tem acesso a essa Receita!');
        }
    }

    public function update(Request $request){
        $income = Income::find($request->id);

        $account = Account::find($request->account_id);

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

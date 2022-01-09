<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Str;
use App\Models\BankIncome;

class BankIncomeController extends Controller
{
    public function setCreate($id){
        $account = Account::find($id);

        $bankIncomes = $account->bankIncomes;

        if($account->school->id === session('school')->id){
            return view('bankIncome.bankIncome', ['account'=>$account, 'bankIncomes'=>$bankIncomes, 'route'=>'addBankIncomePost', 'action'=>'create']);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function create(Request $request){
        $value = Str::of($request->value)->replace('.', '');
        $value = Str::of($value)->replace(',', '.');

        $bankIncome = new BankIncome;

        $bankIncome->account_id = $request->account_id;
        $bankIncome->date_bank_income = $request->date_bank_income;
        $bankIncome->value = $value;

        if($bankIncome->save()){
            return redirect()->route('addBankIncome',['id'=>$bankIncome->account_id])->with('msg', 'Rendimento Salvo com sucesso!');                
        }else{
            return redirect()->route('addBankIncome',['id'=>$bankIncome->account_id])->with('msg', 'Não foi possível Salvar o rendimento!');
        }
    }

    public function delete($id){
        $bankIncome = BankIncome::find($id);
        $account = $bankIncome->account;

        if($account->school_id === session('school')->id){
            $bankIncome->delete();
            return redirect()->route('addBankIncome',['id'=>$bankIncome->account_id])->with('msg', 'Rendimento Excluído com sucesso!');
        }else{
            return redirect()->route('dashboard',['id'=>$bankIncome->account_id])->with('msg', 'Você não tem acesso a esse Rendimento!');
        }
    }

    public function setUpdate($id){
        $bankIncome = BankIncome::find($id);

        $account = $bankIncome->account;

        $bankIncomes = $account->bankIncomes;

        if($account->school->id === session('school')->id){
            return view('bankIncome.bankIncome', ['account'=>$account, 'bankIncome'=>$bankIncome, 'bankIncomes'=>$bankIncomes, 'route'=>'upBankIncomePost', 'action'=>'update']);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function update(Request $request){
        $bankIncome = BankIncome::find($request->id);

        $value = Str::of($request->value)->replace('.', '');
        $value = Str::of($value)->replace(',', '.');

        $bankIncome->account_id = $request->account_id;
        $bankIncome->date_bank_income = $request->date_bank_income;
        $bankIncome->value = $value;

        if($bankIncome->save()){
            return redirect()->route('addBankIncome',['id'=>$bankIncome->account_id])->with('msg', 'Rendimento alterado com sucesso!');                
        }else{
            return redirect()->route('addBankIncome',['id'=>$bankIncome->account_id])->with('msg', 'Não foi possível Alterar o rendimento!');
        }

    }
}

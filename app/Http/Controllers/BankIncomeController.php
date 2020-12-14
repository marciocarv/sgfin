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

        $validate = [
            ['campo'=>'value','value'=>'', 'mask'=>'maskMoney'],
        ];

        if($account->school->id === session('school')->id){
            return view('bankIncome', ['script'=>'validate', 'account'=>$account, 'bankIncomes'=>$bankIncomes, 'javascript'=>true, 'validate'=>$validate, 'route'=>'addBankIncomePost', 'action'=>'create']);
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
}

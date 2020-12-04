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

    public function show($id){
        $school = session('school');

        $account = Account::find($id);

        if($account->school_id === $school->id){
            $expenditure =  new Expenditure;

            $expenditures = $expenditure->expenditureByAccount($account->id);

            return view('expenditure', ['expenditures'=>$expenditures, 'acesso'=>true, 'account'=>$account]);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function setCreate($id){
        $account = Account::find($id);
        $javascript = true;
        $validate = [
            ['campo'=>'value','value'=>'', 'mask'=>'maskMoney'],
        ];

        $school = School::find(session('school')->id);

        //busca todas as ordinances para montar o select
        $options = $school->providers;

        //verifica se o usuário tem acesso a conta.
        if($account->school_id === $school->id){
            return view('formExpenditure', ['javascript'=>$javascript, 'script'=>'expenditure', 'route'=>'addExpenditurePost', 'action'=>'create', 'account'=>$account, 'options'=>$options, 'validate'=>$validate]);
        }else{
            return redirect('dashoboard');
        }
    }

    public function create(Request $request){

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
            $fixed->account_id = $expenditure->account_id;
            $fixed->provider_id = $expenditure->provider_id;
            $fixed->description = $expenditure->description;
            $fixed->value = $expenditure->value;
            $fixed->nature = $expenditure->nature;
            $fixed->emission_date = $expenditure->date_expenditure;
            $fixed->expiration_date = $expenditure->expiration;
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
        $javascript = true;
        $validate = [
            ['campo'=>'value','value'=>'', 'mask'=>'maskMoney'],
        ];
        $expenditure = Expenditure::find($id);
        $school = School::find(session('school')->id);

        //busca todas as ordinances para montar o select
        $options = $school->providers;

        $account = $expenditure->account;

        if($account->school_id === session('school')->id){
            return view('formExpenditure', ['javascript'=>$javascript, 'script'=>'expenditure', 'expenditure'=>$expenditure, 'route'=>'upExpenditurePost', 'action'=>'update', 'account'=>$account, 'options'=>$options, 'validate'=>$validate]);
        }else{
            return redirect()->route('expenditure',['id'=>$expenditure->account_id])->with('msg', 'Você não tem acesso a essa Despesa!');
        }
    }

    public function update(Request $request){
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
                $fixed->account_id = $expenditure->account_id;
                $fixed->provider_id = $expenditure->provider_id;
                $fixed->description = $expenditure->description;
                $fixed->value = $expenditure->value;
                $fixed->nature = $expenditure->nature;
                $fixed->emission_date = $expenditure->date_expenditure;
                $fixed->expiration_date = $expenditure->expiration;
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

        if($expenditure->pay){
            $expenditure->pay->date_pay = Carbon::parse($expenditure->pay->date_pay);
            $expenditure->pay->emission_invoice = Carbon::parse($expenditure->pay->emission_invoice);
        }

        if($expenditure->account->school_id === session('school')->id){
            
            return view('detailExpenditure', ['expenditure'=>$expenditure, 'acesso'=>true]);
        }else{
            return view('detailExpenditure', ['acesso'=>false]);
        }
    }
}

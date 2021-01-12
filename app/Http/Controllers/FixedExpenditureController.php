<?php

namespace App\Http\Controllers;

use App\Models\FixedExpenditure;
use App\Models\Account;
use App\Models\Expenditure;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FixedExpenditureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id){
        $school = session('school');

        $account = Account::find($id);

        if($account->school_id === $school->id){
            $fixedExpenditure = new FixedExpenditure;

            $fixedExpenditures = $fixedExpenditure->fixedExpendituresBySchool($account->id);

            return view('fixedExpenditure', ['fixedExpenditures'=>$fixedExpenditures, 'acesso'=>true, 'account'=>$account]);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function setGerar($id){

        $fe = FixedExpenditure::find($id);

        $school = session('school');

        $account = Account::find($fe->account_id);

        if($account->school_id === $school->id){

            $fe->reference_month = date('m', strtotime($fe->emission_date));
            $fe->description = $fe->description." - ".$fe->reference_month;

            $provider = Provider::find($fe->provider_id);

            return view('gerExpenditure', ['fe'=>$fe, 'account'=>$account, 'provider'=>$provider]);
        }else{
            return redirect()->route('dashboard');
        }

    }

    public function gerar(Request $request){

        $fe = FixedExpenditure::find($request->fe);
        $expenditure = new Expenditure;

        $value = Str::of($request->value)->replace('.', '');
        $value = Str::of($value)->replace(',', '.');

        $fe->reference_month = $request->ref_month;
        $fe->expiration_date = date('Y-m-d',strtotime('+1 month', strtotime($fe->expiration_date)));
        $fe->emission_date = date('Y-m-d',strtotime('+1 month', strtotime($fe->emission_date)));
        $fe->value = $value;

        $expenditure->account_id = $request->account_id;
        $expenditure->provider_id = $request->provider_id;
        $expenditure->description = $request->description;
        $expenditure->date_expenditure = $request->date_expenditure;
        $expenditure->value = $value;
        $expenditure->nature = $request->nature;
        $expenditure->fixed = $request->fixed;
        $expenditure->expiration = $request->expiration;



        $fe->save();
        $expenditure->save();

        return redirect()->route('expenditure', ['id'=>$expenditure->account_id])->with('msg', 'Despesa Gerada com sucesso!');
    }

    public function verifyFixedExpenditure($id){
        
        $fe = new FixedExpenditure;

        $data = date('Y-m-d');
        $ref_month = date('m', strtotime('-1 month'));

        $result =  $fe->fixedBySchool($id, $data, $ref_month);

        return $result;
    }

}

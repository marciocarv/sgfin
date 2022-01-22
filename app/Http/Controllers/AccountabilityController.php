<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Accountability;
use App\Models\School;
use App\Models\AccFormat;
use App\Models\Account;

class AccountabilityController extends Controller
{
    public function show(Request $request){
        $accountability = new Accountability;

        if($request->year){
            $year = $request->year;
        }else{
            $year = now()->format('Y');
        }

        $accountabilities = $accountability->accountabilityBySchool(session('school')->id, $year);

        return view('accountability.accountability', ['accountabilities'=>$accountabilities, 'year'=>$year]);

    }

    public function setCreate(){
        $school = School::find(session('school')->id);
        $accounts = $school->accounts;

        return view('accountability.formAccountability', ['accounts'=>$accounts, 'route'=>'addAccountabilityPost', 'action'=>'create']);
    }

    public function create(Request $request){
        //validação
        $request->validate([
            'account_id'=>'required|numeric',
            'num_process'=>'required',
            'description'=>'required',
            'year'=>'required|numeric',
            'format'=>'required'
        ]);

        $accountability = new Accountability;

        $accountability->account_id = $request->account_id;
        $accountability->num_process = $request->num_process;
        $accountability->description = $request->description;
        $accountability->year = $request->year;
        $accountability->format = $request->format;
        $accountability->save();

        if($accountability->format == 'A'){
            $accFormat = new AccFormat;
            $accFormat->accountability_id = $accountability->id;
            $accFormat->initial_date = Carbon::create($accountability->year, 1, 1);
            $accFormat->final_date = Carbon::create($accountability->year, 12, 31);
            $accFormat->description = 'Prestação de Contas Anual';
            $accFormat->save();

        }else if($accountability->format == 'S'){
            $accFormat1 = new AccFormat;
            $accFormat1->accountability_id = $accountability->id;
            $accFormat1->initial_date = Carbon::create($accountability->year, 1, 1);
            $accFormat1->final_date = Carbon::create($accountability->year, 6, 30);
            $accFormat1->description = '1º Semestre';
            $accFormat1->save();

            $accFormat2 = new AccFormat;
            $accFormat2->accountability_id = $accountability->id;
            $accFormat2->initial_date = Carbon::create($accountability->year, 7, 1);
            $accFormat2->final_date = Carbon::create($accountability->year, 12, 31);
            $accFormat2->description = '2º Semestre';
            $accFormat2->save();
            
        }else if($accountability->format == 'Q'){
            $accFormat1 = new AccFormat;
            $accFormat1->accountability_id = $accountability->id;
            $accFormat1->initial_date = Carbon::create($accountability->year, 1, 1);
            $accFormat1->final_date = Carbon::create($accountability->year, 4, 30);
            $accFormat1->description = '1º Quadrimestre';
            $accFormat1->save();

            $accFormat2 = new AccFormat;
            $accFormat2->accountability_id = $accountability->id;
            $accFormat2->initial_date = Carbon::create($accountability->year, 5, 1);
            $accFormat2->final_date = Carbon::create($accountability->year, 8, 31);
            $accFormat2->description = '2º Quadrimestre';
            $accFormat2->save();

            $accFormat3 = new AccFormat;
            $accFormat3->accountability_id = $accountability->id;
            $accFormat3->initial_date = Carbon::create($accountability->year, 9, 1);
            $accFormat3->final_date = Carbon::create($accountability->year, 12, 31);
            $accFormat3->description = '3º Quadrimestre';
            $accFormat3->save();

        }else if($accountability->format == 'T'){
            $accFormat1 = new AccFormat;
            $accFormat1->accountability_id = $accountability->id;
            $accFormat1->initial_date = Carbon::create($accountability->year, 1, 1);
            $accFormat1->final_date = Carbon::create($accountability->year, 3, 31);
            $accFormat1->description = '1º Trimestre';
            $accFormat1->save();

            $accFormat2 = new AccFormat;
            $accFormat2->accountability_id = $accountability->id;
            $accFormat2->initial_date = Carbon::create($accountability->year, 4, 1);
            $accFormat2->final_date = Carbon::create($accountability->year, 6, 30);
            $accFormat2->description = '2º Trimestre';
            $accFormat2->save();

            $accFormat3 = new AccFormat;
            $accFormat3->accountability_id = $accountability->id;
            $accFormat3->initial_date = Carbon::create($accountability->year, 7, 1);
            $accFormat3->final_date = Carbon::create($accountability->year, 9, 30);
            $accFormat3->description = '3º Trimestre';
            $accFormat3->save();

            $accFormat4 = new AccFormat;
            $accFormat4->accountability_id = $accountability->id;
            $accFormat4->initial_date = Carbon::create($accountability->year, 10, 1);
            $accFormat4->final_date = Carbon::create($accountability->year, 12, 31);
            $accFormat4->description = '4º Trimestre';
            $accFormat4->save();
        }else if($accountability->format == 'B'){
            $accFormat1 = new AccFormat;
            $accFormat1->accountability_id = $accountability->id;
            $accFormat1->initial_date = Carbon::create($accountability->year, 1, 1);
            $accFormat1->final_date = Carbon::create($accountability->year, 2, 28);
            $accFormat1->description = '1º Bimestre';
            $accFormat1->save();

            $accFormat2 = new AccFormat;
            $accFormat2->accountability_id = $accountability->id;
            $accFormat2->initial_date = Carbon::create($accountability->year, 3, 1);
            $accFormat2->final_date = Carbon::create($accountability->year, 4, 30);
            $accFormat2->description = '2º Bimestre';
            $accFormat2->save();

            $accFormat3 = new AccFormat;
            $accFormat3->accountability_id = $accountability->id;
            $accFormat3->initial_date = Carbon::create($accountability->year, 5, 1);
            $accFormat3->final_date = Carbon::create($accountability->year, 6, 30);
            $accFormat3->description = '3º Bimestre';
            $accFormat3->save();

            $accFormat4 = new AccFormat;
            $accFormat4->accountability_id = $accountability->id;
            $accFormat4->initial_date = Carbon::create($accountability->year, 7, 1);
            $accFormat4->final_date = Carbon::create($accountability->year, 8, 31);
            $accFormat4->description = '4º Bimestre';
            $accFormat4->save();

            $accFormat5 = new AccFormat;
            $accFormat5->accountability_id = $accountability->id;
            $accFormat5->initial_date = Carbon::create($accountability->year, 9, 1);
            $accFormat5->final_date = Carbon::create($accountability->year, 10, 31);
            $accFormat5->description = '5º Bimestre';
            $accFormat5->save();

            $accFormat6 = new AccFormat;
            $accFormat6->accountability_id = $accountability->id;
            $accFormat6->initial_date = Carbon::create($accountability->year, 11, 1);
            $accFormat6->final_date = Carbon::create($accountability->year, 12, 31);
            $accFormat6->description = '6º Bimestre';
            $accFormat6->save();
        }

        return redirect()->route('accountability')->with('msg', 'Prestação de Contas Salva com sucesso!');
    }

    public function manage($id){
        $accountability = Accountability::find($id);

        $accFormats = $accountability->accFormats;

        $account = Account::find($accountability->account_id);

        foreach($accFormats as $accFormat){

            $ballance = $account->ballance($account->id, null, $accFormat->final_date);

            $expenditure = $account->sumExpenditure($account->id, $accFormat->initial_date, $accFormat->final_date);

            $income = $account->sumIncome($account->id, $accFormat->initial_date, $accFormat->final_date);

            $bankIncome = $account->sumBankIncome($account->id, $accFormat->initial_date, $accFormat->final_date);

            $previous_ballance = $account->previousBallance($account->id, $accFormat->initial_date);

            $accFormat->ballance = $ballance;
            $accFormat->income = $income + $bankIncome;
            $accFormat->expenditure = $expenditure;
            $accFormat->previous_ballance = $previous_ballance;

            setlocale(LC_TIME, 'pt_br'); // LC_TIME é formatação de data e hora com strftime()
            $accFormat->mes_inicial = $accFormat->initial_date->formatLocalized('%B');
            $accFormat->mes_final = $accFormat->final_date->formatLocalized('%B');
        }

        //dd($accFormats);exit;

        if($accountability->account->school_id == session('school')->id){
            return view('accountability.manageAccountability', ['accountability'=>$accountability, 'accFormats'=>$accFormats]);
        }else{
            return redirect()->route('dashboard');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccFormat;
use App\Models\Account;
use App\Models\Expenditure;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;;

class DocumentController extends Controller
{
    public function teste(){
        $accFormat = AccFormat::find(8);
        $pdf = PDF::loadView('documents.teste', compact('accFormat'));
        return $pdf->setPaper('a4')->stream('capa.pdf');
    }
    public function setPdfCapa($id){

        $accFormat = AccFormat::find($id);
        if($accFormat->accountability->account->school_id === session('school')->id){
            setlocale(LC_TIME, 'pt_br'); // LC_TIME é formatação de data e hora com strftime()
            $accFormat->mes_inicial = $accFormat->initial_date->formatLocalized('%B');
            $accFormat->mes_final = $accFormat->final_date->formatLocalized('%B');

            //dd($accFormat->description);

            $pdf = PDF::loadView('documents.capa', compact('accFormat'));
            return $pdf->setPaper('a4')->stream('capa.pdf');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function setPdfRerd($id){
        $accFormat = AccFormat::find($id);
        if($accFormat->accountability->account->school_id === session('school')->id){
            setlocale(LC_TIME, 'pt_br'); // LC_TIME é formatação de data e hora com strftime()
            $accFormat->mes_inicial = $accFormat->initial_date->formatLocalized('%B');
            $accFormat->mes_final = $accFormat->final_date->formatLocalized('%B');
            $account = $accFormat->accountability->account;

            $previousBallance = $account->previousBallance($account->id, $accFormat->initial_date);
            $previousBallanceCusteio = $account->ballanceCusteio($account->id, $accFormat->initial_date);
            $previousBallanceCapital = $account->ballanceCapital($account->id, $accFormat->initial_date);
            $fullIncomes = $account->sumIncome($account->id, $accFormat->initial_date, $accFormat->final_date);
            $fullExpenditures = $account->sumExpenditure($account->id, $accFormat->initial_date, $accFormat->final_date);
            $ballanceCapital = $account->ballanceCapital($account->id, $accFormat->final_date);
            $ballanceCusteio = $account->ballanceCusteio($account->id, $accFormat->final_date);
            $incomeCusteio = $account->sumIncomeNature($account->id, $accFormat->initial_date, $accFormat->final_date, 'value_custeio');
            $incomeCapital = $account->sumIncomeNature($account->id, $accFormat->initial_date, $accFormat->final_date, 'value_capital');
            $devolutionCusteio = $account->devolutionNature($account->id, $accFormat->initial_date, $accFormat->final_date, 'value_custeio');
            $devolutionCapital = $account->devolutionNature($account->id, $accFormat->initial_date, $accFormat->final_date, 'value_capital');
            $expenditureCapital = $account->sumExpenditureNature($account->id, $accFormat->initial_date, $accFormat->final_date, 'Capital');
            $expenditureCusteio = $account->sumExpenditureNature($account->id, $accFormat->initial_date, $accFormat->final_date, 'Custeio');
            $bankIncome = $account->sumBankIncome($account->id, $accFormat->initial_date, $accFormat->final_date);
            
            $accFormat->previousBallance = $previousBallance;
            $accFormat->previousBallanceCusteio = $previousBallanceCusteio;
            $accFormat->previousBallanceCapital = $previousBallanceCapital;
            $accFormat->fullIncomes = $fullIncomes + $bankIncome - $devolutionCusteio - $devolutionCapital;
            $accFormat->fullExpenditures = $fullExpenditures;
            $accFormat->ballanceCusteio = $ballanceCusteio - $bankIncome;
            $accFormat->ballanceCapital = $ballanceCapital;
            $accFormat->incomeCusteio = $incomeCusteio - $devolutionCusteio;
            $accFormat->incomeCapital = $incomeCapital - $devolutionCapital;
            $accFormat->devolutionCusteio = $devolutionCusteio;
            $accFormat->devolutionCapital = $devolutionCapital;
            $accFormat->expenditureCapital = $expenditureCapital;
            $accFormat->expenditureCusteio = $expenditureCusteio;
            $accFormat->bankIncome = $bankIncome;
            $accFormat->totalDevolution = $devolutionCapital + $devolutionCusteio;
            $accFormat->saldoFinal = $accFormat->previousBallance + $accFormat->fullIncomes + $accFormat->totalDevolution - $accFormat->fullExpenditures;

            $pdf = PDF::loadView('documents.rerd', compact('accFormat'));

            return $pdf->setPaper('a4', 'landscape')->stream('rerd.pdf');
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function setPdfRelPagamento($id){
        $accFormat = AccFormat::find($id);
        
        if($accFormat->accountability->account->school_id === session('school')->id){
            setlocale(LC_TIME, 'pt_br'); // LC_TIME é formatação de data e hora com strftime()
            $accFormat->mes_inicial = $accFormat->initial_date->formatLocalized('%B');
            $accFormat->mes_final = $accFormat->final_date->formatLocalized('%B');
            $account = $accFormat->accountability->account;
            $expenditure = new Expenditure;

            $fullExpenditures = $account->sumExpenditure($account->id, $accFormat->initial_date, $accFormat->final_date);

            $expPaids = $expenditure->expendituresPaid($account->id, $accFormat->initial_date, $accFormat->final_date);
            
            $accFormat->fullPays = $fullExpenditures;
            
            $pdf = PDF::loadView('documents.relPagamentos', compact('accFormat', 'expPaids'));
            return $pdf->setPaper('a4', 'landscape')->stream('relPagamentos.pdf');
        }else{

        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccFormat;
use Illuminate\Support\Carbon;
use PDF;

class DocumentController extends Controller
{
    public function setCapa($id){

        $accFormat = AccFormat::find($id);
        if($accFormat->accountability->account->school_id === session('school')->id){
            setlocale(LC_TIME, 'pt_br'); // LC_TIME é formatação de data e hora com strftime()
            $accFormat->mes_inicial = $accFormat->initial_date->formatLocalized('%B');
            $accFormat->mes_final = $accFormat->final_date->formatLocalized('%B');

            //dd($accFormat->accountability->account->school->ace->name);exit;

            $pdf = PDF::loadView('documents.capa', compact('accFormat'));

            return $pdf->setPaper('a4')->stream('teste.pdf');
        }else{
            return redirect()->route('dashboard');
        }
    }
}

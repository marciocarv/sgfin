<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;

class testeController extends Controller
{
    public function teste(){
        $data_inicial = mktime(0, 0, 0, date('1'), 1, date('Y'));
        $data_final = mktime(0, 0, 0, date('12'), 31, date('Y'));
        $dataInicial = date('Y-m-d',$data_inicial);
        $dataFinal = date('Y-m-d',$data_final);


        
        print_r($dataInicial);
    }
}

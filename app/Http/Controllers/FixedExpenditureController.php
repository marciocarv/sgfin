<?php

namespace App\Http\Controllers;

use App\Models\FixedExpenditure;
use Illuminate\Http\Request;

class FixedExpenditureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $school = session('school');

        $fixedExpenditure = new FixedExpenditure;

        $fixedExpenditures = $fixedExpenditure->fixedExpendituresBySchool($school->id);

        return view('fixedExpenditure', ['fixedExpenditures'=>$fixedExpenditures, 'acesso'=>true]);
        
    }
}

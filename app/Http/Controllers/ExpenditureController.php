<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Models\Expenditure;
use App\Models\Account;
use App\Models\School;
use Illuminate\Support\Str;

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

    public function create(){
        
    }

    public function update(){
        
    }

    public function delete(){
        
    }
}

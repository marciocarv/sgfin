<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\Expenditure;

class homeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();

        if($user->tenancy){
            if (session()->exists('school')) {
                //## verificação se há alguma despesa fixa que precisa ser gerada.
                $fe = new FixedExpenditureController;

                $school = School::find(session('school')->id);

                $pendingFixedExpenditures = $fe->verifyFixedExpenditure($school->id);
                //#######fim da verificação

                //##listagem das contas a vencer
                $Expenditure = new Expenditure;
                $pendingExpenditures = $Expenditure->PendingExpenditureBySchool(session('school')->id);                
                //######fim da listagem

                //## listagem de contas na página inicial
                $accounts = $school->accounts;

                $accountsSaldo = [];

                foreach($accounts as $account){
                    $ballance = $account->ballance($account->id);
                    $accountsSaldo[] = ["ballance"=>$ballance, "account"=>$account];
                }

                //######fim da lista

                return view('dashboard', ['accountsSaldo'=>$accountsSaldo, 'pendingFixedExpenditures'=>$pendingFixedExpenditures, 'pendingExpenditures'=>$pendingExpenditures]);
            }else{
                $schoolSession = $user->tenancy->school;
                $school = School::find($schoolSession->id);
                session(['school' => $school]);
                
                return redirect()->route('dashboard');
            }
        }else{
            return redirect()->route('addSchool');
        }
    }

}

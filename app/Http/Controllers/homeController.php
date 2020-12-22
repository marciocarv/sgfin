<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;

class homeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();

        if($user->tenancy){
            if (session()->exists('school')) {
                $school = School::find(session('school')->id);

                $accounts = $school->accounts;

                $accountsSaldo = [];

                foreach($accounts as $account){
                    $ballance = $account->ballance($account->id);
                    $accountsSaldo[] = ["ballance"=>$ballance, "account"=>$account];
                }

                return view('dashboard', ['accountsSaldo'=>$accountsSaldo]);
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

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
                return view('dashboard');
            }else{
                $schoolSession = $user->tenancy->school;
                $school = School::find($schoolSession->id);
                session(['school' => $school]);
                return view('dashboard');
            }            
        }else{
            return redirect()->route('addSchool');
        }
    }
}

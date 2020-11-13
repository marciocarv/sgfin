<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();

        if($user->tenancy){
            $school = $user->tenancy->school;
            session(['school' => $school]);
            return view('dashboard');
        }else{
            return redirect()->route('addSchool');
        }
    }
}

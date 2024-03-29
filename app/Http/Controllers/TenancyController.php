<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenancy;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

class TenancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        
        $school = School::find(session('school')->id);
        $user = Auth::user();

        return view('profile.profile', ['school'=>$school, 'user'=>$user]);
    }

    public function create($school, $user, $module){
        $tenancy = new Tenancy();
        $tenancy->school_id = $school;
        $tenancy->user_id = $user;
        $tenancy->module = $module;

        if($tenancy->save()){
            return true;
        }else{
            return false;
        }
    }

    public function update(){
        
    }

    public function delete(){
        
    }
}

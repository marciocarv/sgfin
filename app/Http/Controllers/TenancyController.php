<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenancy;

class TenancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        
    }

    public function create($school, $user){
        $tenancy = new Tenancy();
        $tenancy->school_id = $school;
        $tenancy->user_id = $user;
        $tenancy->module = 'FINANCEIRO';

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

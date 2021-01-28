<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountabilityController extends Controller
{
    public function show(){
        $accountability = new Accountability;

        $accountabilitys = $accountability->accountabilityBySchool(session('school')->id);

        print_r($accountabilitys);

    }
}

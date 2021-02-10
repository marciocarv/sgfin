<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accountability;

class AccountabilityController extends Controller
{
    public function show(Request $request){
        $accountability = new Accountability;

        if($request->year){
            $year = $request->year;
        }else{
            $year = now()->format('Y');
        }

        $accountabilities = $accountability->accountabilityBySchool(session('school')->id, $year);

        return view('accountability', ['accountabilities'=>$accountabilities, 'year'=>$request->year]);

    }
}

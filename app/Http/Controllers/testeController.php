<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;

class testeController extends Controller
{
    public function teste(){
        session()->forget('school');
        if (session()->exists('school')) {
            echo "existe";
        }else{
            echo "não existe";
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        
    }

    public function create(){
        
    }

    public function update(){
        
    }

    public function delete(){
        
    }
}

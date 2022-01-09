<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function setUpdate($id){
        $user = User::find($id);

        if($user->id === Auth::user()->id){
            return view('profile.formUser', ['user'=>$user]);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function update(Request $request){
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('profile')->with('msg', 'Perfil Alterado com sucesso!');
    }

    public function delete(){
        
    }
}

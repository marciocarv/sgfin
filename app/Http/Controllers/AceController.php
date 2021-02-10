<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Ace;

class AceController extends Controller
{
    public function setUpdate($id){
        $ace = Ace::find($id);

        if($ace->school_id === session('school')->id){
            return view('formAce', ['ace'=>$ace]);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function update(Request $request){
        $ace = Ace::find($request->id);

        $ace->name = $request->name;
        $ace->presidente = $request->presidente;
        $ace->vice_presidente = $request->vice_presidente;
        $ace->secretario = $request->secretario;
        $ace->segundo_secretario = $request->segundo_secretario;
        $ace->tesoureiro = $request->tesoureiro;
        $ace->segundo_tesoureiro = $request->segundo_tesoureiro;
        $ace->membro_1 = $request->membro_1;
        $ace->membro_2 = $request->membro_2;
        $ace->membro_3 = $request->membro_3;

        $ace->save();

        return redirect()->route('profile')->with('msg', 'ACE editada com sucesso!');

    }
}

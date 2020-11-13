<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordinance;
class OrdinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        
    }

    public function create(Request $request){
        if($request->input('description') == null || $request->input('date_ordinance') == null){
            return view('formOrdinance');
        }else{
            
            $school = session('school');

            $ordinance = new Ordinance;
            $ordinance->school_id = $school->id;
            $ordinance->description = $request->description;
            $ordinance->date_ordinance = $request->date_ordinance;
            $ordinance->number_diario = $request->number_diario;
            $ordinance->nature = $request->nature;
            $ordinance->font = $request->font;
            $ordinance->value_capital = $request->value_capital;
            $ordinance->value_custeio = $request->value_custeio;
            $ordinance->amount = $request->amount;

            $image = $request->image->store('images');

            $ordinance->image = $image;

            if($ordinance->save()){
                return view('formOrdinance', ['msg'=>'Portaria Salva com sucesso!']);                
            }else{
                return view('formOrdinance', ['msg'=>'Não foi possível salvar sua Portaria!']);
            }
        }
    }

    public function update(){
        
    }

    public function delete(){
        
    }
}

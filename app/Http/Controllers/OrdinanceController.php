<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Ordinance;

class OrdinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $school = session('school');
        $ordinance =  new Ordinance;

        $ordinances = $ordinance->ordinanceBySchool($school->id);

        return view('ordinance.ordinance', ['ordinances'=>$ordinances, 'acesso'=>true]);
    }

    public function create(Request $request){
        if($request->input('description') == null || $request->input('date_ordinance') == null){
            return view('ordinance.formOrdinance', ['route'=>'addOrdinance', 'action'=>'create']);
        }else{
            //tratamento dos valores
            $amount = Str::of($request->amount)->replace('.', '');
            $amount = Str::of($amount)->replace(',', '.');

            $value_custeio = Str::of($request->value_custeio)->replace('.', '');
            $value_custeio = Str::of($value_custeio)->replace(',', '.');

            $value_capital = Str::of($request->value_capital)->replace('.', '');
            $value_capital = Str::of($value_capital)->replace(',', '.');

            //montagem do objeto ordinance para inserir
            $school = session('school');
            $ordinance = new Ordinance;
            $ordinance->school_id = $school->id;
            $ordinance->number = $request->number;
            $ordinance->description = $request->description;
            $ordinance->date_ordinance = $request->date_ordinance;
            $ordinance->number_diario = $request->number_diario;
            $ordinance->number_process = $request->number_process;
            $ordinance->nature = $request->nature;
            $ordinance->source = $request->source;
            $ordinance->value_custeio = $value_custeio;
            $ordinance->value_capital = $value_capital;
            $ordinance->amount = $amount;

            if($ordinance->save()){
                return redirect('portaria')->with('msg', 'Portaria Salva com sucesso!');                
            }else{
                return redirect('portaria/add')->with('msg', 'Não foi possível Salvar a portaria!');
            }
        }
    }

    public function setUpdate($id){

        $ordinance = Ordinance::find($id);
        if($ordinance->school_id === session('school')->id){
            return view('ordinance.formOrdinance', ['ordinance'=>$ordinance, 'route'=>'upOrdinancePost', 'action'=>'update']);
        }else{
            return redirect('portaria')->with('msg', 'Você não tem acesso a essa Portaria!');
        }
    }

    public function update(Request $request){
        $ordinance = Ordinance::find($request->id);

        $amount = Str::of($request->amount)->replace('.', '');
        $amount = Str::of($amount)->replace(',', '.');

        $ordinance->number = $request->number;
        $ordinance->description = $request->description;
        $ordinance->date_ordinance = $request->date_ordinance;
        $ordinance->number_diario = $request->number_diario;
        $ordinance->number_process = $request->number_process;
        $ordinance->nature = $request->nature;
        $ordinance->source = $request->source;
        $ordinance->amount = $amount;

        if($ordinance->save()){
            return redirect('portaria')->with('msg', 'Portaria editada com sucesso!');                
        }else{
            return redirect('portaria')->with('msg', 'Não foi possível Editar a portaria!');
        }
    }

    public function delete($id){
        $ordinance = Ordinance::find($id);
        if($ordinance->school_id === session('school')->id){
            $ordinance->delete();
            return redirect('portaria')->with('msg', 'Portaria Excluída com sucesso!');
        }else{
            return redirect('portaria')->with('msg', 'Você não tem acesso a essa Portaria!');
        }
    }

    public function detail($id){
        $ordinance = Ordinance::find($id);

        if($ordinance->school_id === session('school')->id){
            $incomes = $ordinance->incomes;
            $bidding = $ordinance->bidding;
            return view('ordinance.detailOrdinance', ['ordinance'=>$ordinance, 'acesso'=>true, 'incomes'=>$incomes, 'bidding'=>$bidding]);
        }else{
            return view('ordinance.detailOrdinance', ['acesso'=>false]);
        }
    }
}

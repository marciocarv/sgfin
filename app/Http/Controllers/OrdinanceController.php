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

    public function show(Request $request){
        $school = session('school');
        $ordinance =  new Ordinance;

         //se a data inicial e a data final vierem vazias, as datas padrão os três ultimos meses
         if(!$request->dataInicial || !$request->dataFinal){
            $data_inicio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
            $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));

            $data_base_inicial = date('Y-m-d', $data_inicio);
            $dataInicial = date("Y-m-d",strtotime(date("Y-m-d",strtotime($data_base_inicial))."-3 month"));
            $dataFinal = date('Y-m-d',$data_fim);
        }else{
            $dataInicial = $request->dataInicial;
            $dataFinal = $request->dataFinal;
        }

        $ordinances = $ordinance->ordinanceBySchool($school->id, $dataInicial, $dataFinal);

        return view('ordinance.ordinance', ['ordinances'=>$ordinances, 
                                            'acesso'=>true, 
                                            'dataInicial'=>$dataInicial,
                                            'dataFinal'=>$dataFinal]);
    }

    public function setCreate(){
        return view('ordinance.formOrdinance', ['route'=>'addOrdinance', 'action'=>'create']);
    }

    public function create(Request $request){

            $request->validate([
                'number'=>'required|numeric',
                'description'=>'required',
                'date_ordinance'=>'required|date_format:Y-m-d',
                'nature'=>'required',
                'source'=>'required',
                'value_custeio'=>'required',
                'value_capital'=>'required',
            ]);


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

    public function setUpdate($id){

        $ordinance = Ordinance::find($id);
        if($ordinance->school_id === session('school')->id){
            return view('ordinance.formOrdinance', ['ordinance'=>$ordinance, 'route'=>'upOrdinancePost', 'action'=>'update']);
        }else{
            return redirect('portaria')->with('msg', 'Você não tem acesso a essa Portaria!');
        }
    }

    public function update(Request $request){
        $request->validate([
            'number'=>'required|numeric',
            'description'=>'required',
            'date_ordinance'=>'required|date_format:Y-m-d',
            'nature'=>'required',
            'source'=>'required',
            'value_custeio'=>'required',
            'value_capital'=>'required',
        ]);

        $ordinance = Ordinance::find($request->id);

        $amount = Str::of($request->amount)->replace('.', '');
        $amount = Str::of($amount)->replace(',', '.');

        $value_custeio = Str::of($request->value_custeio)->replace('.', '');
        $value_custeio = Str::of($value_custeio)->replace(',', '.');

        $value_capital = Str::of($request->value_capital)->replace('.', '');
        $value_capital = Str::of($value_capital)->replace(',', '.');

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

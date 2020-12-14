<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\School;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $school = session('school');
        $account =  new Account;

        $accounts = $account->accountBySchool($school->id);

        $accountsSaldo = [];

        foreach($accounts as $account){
            $ballance = $account->ballance($account->id);
            $accountsSaldo[] = ["ballance"=>$ballance, "account"=>$account];
        }

        return view('account', ['accountsSaldo'=>$accountsSaldo, 'acesso'=>true]);
    }

    public function choose($movimento){
        $school = School::find(session('school')->id);

        if($movimento === 'in'){
            $titulo = 'Escolha a Conta em que o recurso será creditado';
            $route = 'income';
        }elseif($movimento === 'out'){
            $titulo = 'Escolha a Conta em que o despesa será debitada';
            $route = 'expenditure';
        }else{
            return redirect('dashboard');
        }

        $accounts = $school->accounts;


        return view('choose', ['accounts'=>$accounts, 'acesso'=>true, 'titulo'=>$titulo, 'route'=>$route]);
    }

    public function create(Request $request){
        $javascript = false;
        if($request->input('number') == null || $request->input('agency') == null){
            return view('formAccount', ['javascript'=>$javascript, 'route'=>'addAccount', 'action'=>'create']);
        }else{
            
            //montagem do objeto account para inserir
            $school = session('school');
            $account = new Account;
            $account->school_id = $school->id;
            $account->number = $request->number;
            $account->agency = $request->agency;
            $account->description = $request->description;

            if($account->save()){
                return redirect('conta')->with('msg', 'Conta Salva com sucesso!');                
            }else{
                return redirect('conta/add')->with('msg', 'Não foi possível Salvar a conta!');
            }
        }
    }

    public function manage($id, Request $request){

        //se a data inicial e a data final vierem vazias, as datas padrão serão o primeiro e ultimo dia do mês atual
        if(!$request->dataInicial || !$request->dataFinal){
            $data_incio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
            $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));

            $dataInicial = date('Y-m-d',$data_incio);
            $dataFinal = date('Y-m-d',$data_fim);
        }else{
            $dataInicial = $request->dataInicial;
            $dataFinal = $request->dataFinal;
        }


        $account = Account::find($id);

        if($account->school_id === session('school')->id){
            $incomes = $account->incomes->where('date_income','>=', $dataInicial)->where('date_income', '<=', $dataFinal);

            $expenditures = $account->expenditurePaid($id, $dataInicial, $dataFinal);

            return view('manageAccount', ['account'=>$account, 'incomes'=>$incomes, 'expenditures'=>$expenditures, 'dataInicial'=>$dataInicial, 'dataFinal'=>$dataFinal]);
        }else{
            return redirect('dashboard');
        }
    }

    public function setUpdate($id){
        $javascript = false;
        $account = Account::find($id);
        if($account->school_id === session('school')->id){
            return view('formAccount', ['javascript'=>$javascript, 'account'=>$account, 'route'=>'upAccountPost', 'action'=>'update']);
        }else{
            return redirect('conta')->with('msg', 'Você não tem acesso a essa Conta!');
        }
    }

    public function update(Request $request){
        $account = Account::find($request->id);

            $account->number = $request->number;
            $account->agency = $request->agency;
            $account->description = $request->description;

        if($account->save()){
            return redirect('conta')->with('msg', 'Conta alterada com sucesso!');                
        }else{
            return redirect('conta')->with('msg', 'Não foi possível Alterar a conta!');
        }
    }

    public function delete($id){
        $account = Account::find($id);
        if($account->school_id === session('school')->id){
            $account->delete();
            return redirect('conta')->with('msg', 'Conta excluída com sucesso!');
        }else{
            return redirect('conta')->with('msg', 'Você não tem acesso a essa Conta!');
        }
        
        
    }
}

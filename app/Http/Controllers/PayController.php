<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pay;
use App\Models\Expenditure;

class PayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setPay($id){

        $javascript = true;
        $validate = [
            ['campo'=>'','value'=>'', 'mask'=>''],
        ];

        $expenditure = Expenditure::find($id);

        $account = $expenditure->account;

        $school = $expenditure->account->school;

        if($school->id === session('school')->id){
            return view('formPay', ['expenditure'=>$expenditure, 'javascript'=>$javascript, 'script'=>'validate', 'route'=>'addPay', 'action'=>'create', 'validate'=>$validate]);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function create(Request $request){
        $pay = new Pay;
        
        $pay->expenditure_id = $request->id_expenditure;
        $pay->date_pay = $request->date_pay;
        $pay->number_invoice = $request->number_invoice;
        $pay->emission_invoice = $request->emission_invoice;
        $pay->payment_method = $request->payment_method;

        if($pay->save()){
            return redirect()->route('detailExpenditure',['id'=>$pay->expenditure_id])->with('msg', 'Pagamento Registrado com sucesso!');                
        }else{
            return redirect()->route('detailExpenditure',['id'=>$pay->expenditure_id])->with('msg', 'Não foi possível Registrar o pagamento!');
        }
    }

    public function update(){
        
    }

    public function delete($id){
        $pay = Pay::find($id);
        $expenditure = $pay->expenditure;

        if($expenditure->account->school_id === session('school')->id){
            $pay->delete();
            return redirect()->route('detailExpenditure', ['id'=>$expenditure->id])->with('msg', 'Pagamento Cancelado com sucesso!');
        }else{
            return redirect()->route('dashboard');
        }
    }
}

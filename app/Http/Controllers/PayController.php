<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pay;
use App\Models\Expenditure;
use Illuminate\Support\Str;

class PayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setPay($id){

        $expenditure = Expenditure::find($id);

        $account = $expenditure->account;

        $school = $expenditure->account->school;

        if($school->id === session('school')->id){
            return view('pay.formPay', ['expenditure'=>$expenditure, 'route'=>'addPay', 'action'=>'create']);
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function create(Request $request){
        $pay = new Pay;

        $interest = Str::of($request->interest)->replace('.', '');
        $interest = Str::of($interest)->replace(',', '.');
        $tax = Str::of($request->tax)->replace('.', '');
        $tax = Str::of($tax)->replace(',', '.');
        $value_paid = Str::of($request->value_paid)->replace('.', '');
        $value_paid = Str::of($value_paid)->replace(',', '.');
        
        $pay->expenditure_id = $request->id_expenditure;
        $pay->date_pay = $request->date_pay;
        $pay->number_invoice = $request->number_invoice;
        $pay->emission_invoice = $request->emission_invoice;
        $pay->payment_method = $request->payment_method;
        $pay->interest = $interest;
        $pay->document_type = $request->document_type;
        $pay->tax = $tax;
        $pay->number_cheque = $request->number_cheque;
        $pay->value_paid = $value_paid;

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

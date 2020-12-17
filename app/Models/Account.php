<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'agency',
        'description'
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function incomes(){
        return $this->hasMany(Income::class);
    }

    public function bankIncomes(){
        return $this->hasMany(BankIncome::class);
    }

    public function expenditures(){
        return $this->hasMany(Expenditure::class);
    }

    public function sumIncome($id){
        return Income::where('account_id', $id)
        ->sum('amount');
    }

    public function ballance($id, $dataInicial = null, $dataFinal = null){

        if($dataInicial == null){
            $data_inicial = mktime(0, 0, 0, date('1'), 1, date('Y'));
            $dataInicial = date('Y-m-d',$data_inicial);
        }
        if($dataFinal == null){
            $data_final = mktime(0, 0, 0, date('12'), 31, date('Y'));
            $dataFinal = date('Y-m-d',$data_final);
        }

        $expenditure = Expenditure::where('account_id', $id)
        ->Join('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->where('pays.date_pay','>=', $dataInicial)->where('pays.date_pay', '<=', $dataFinal)
        ->sum('expenditures.value');

        $income = Income::where('account_id', $id)
        ->where('date_income','>=', $dataInicial)->where('date_income', '<=', $dataFinal)
        ->sum('amount');

        $bankIncome = BankIncome::where('account_id', $id)
        ->where('date_bank_income','>=', $dataInicial)->where('date_bank_income', '<=', $dataFinal)
        ->sum('value');

        $ballance = ($income + $bankIncome) - $expenditure;

        return $ballance;
    }

    public function previousBallance($id, $data){

        $expenditure = Expenditure::where('account_id', $id)
        ->Join('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->where('pays.date_pay','<', $data)
        ->sum('expenditures.value');

        $income = Income::where('account_id', $id)
        ->where('date_income','<', $data)
        ->sum('amount');

        $bankIncome = BankIncome::where('account_id', $id)
        ->where('date_bank_income','<', $data)
        ->sum('value');

        $previousBallance = ($income + $bankIncome) - $expenditure;

        return $previousBallance;
    }

    public function expenditurePaid($id, $dataInicial, $dataFinal){
        return Expenditure::where('account_id', $id)
        ->Join('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->where('pays.date_pay','>=', $dataInicial)->where('pays.date_pay', '<=', $dataFinal)
        ->select('expenditures.*', 'pays.date_pay')
        ->orderBy('pays.date_pay', 'desc')
        ->get();
    }

    public function accountBySchool($id){
        $account = Account::where('school_id', $id)->paginate(25);
        return $account;
    }
}

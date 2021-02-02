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

    public function incomesByAccount($id, $dataInicial, $dataFinal){
        return Income::where('account_id', $id)
        ->where('date_income', '>=', $dataInicial)->where('date_income', '<=', $dataFinal)
        ->orderBy('date_income')
        ->get();
    }

    public function bankIncomesByAccount($id, $dataInicial, $dataFinal){
        return bankIncome::where('account_id', $id)
        ->where('date_bank_income', '>=', $dataInicial)->where('date_bank_income', '<=', $dataFinal)
        ->orderBy('date_bank_income')
        ->get();
    }

    public function ballance($id, $dataInicial = null, $dataFinal = null){

        if($dataInicial == null){
            $dataInicial = '2000-01-01';
        }
        if($dataFinal == null){
            $data_final = mktime(0, 0, 0, date('12'), 31, date('Y'));
            $dataFinal = date('Y-m-d',$data_final);
        }

        $expenditure = $this->sumExpenditure($id, $dataInicial, $dataFinal);

        $income = $this->sumIncome($id, $dataInicial, $dataFinal);

        $bankIncome = $this->sumBankIncome($id, $dataInicial, $dataFinal);

        $ballance = ($income + $bankIncome) - ($expenditure);

        return $ballance;
    }

    public function ballanceCapital($id, $dataFinal = null){
        if($dataFinal == null){
            $data_final = mktime(0, 0, 0, date('12'), 31, date('Y'));
            $dataFinal = date('Y-m-d',$data_final);
        }

        $expenditureCapital = $this->sumExpenditureNature($id, $dataFinal, 'Capital');

        $incomeCapital = $this->sumIncomeNature($id, $dataFinal, 'value_capital');

        return $incomeCapital - $expenditureCapital;

    }

    public function ballanceCusteio($id, $dataFinal = null){
        if($dataFinal == null){
            $data_final = mktime(0, 0, 0, date('12'), 31, date('Y'));
            $dataFinal = date('Y-m-d',$data_final);
        }

        $dataInicial = '2000-01-01';

        $expenditureCusteio = $this->sumExpenditureNature($id, $dataFinal, 'Custeio');

        $incomeCusteio = $this->sumIncomeNature($id, $dataFinal, 'value_custeio') + $this->sumBankIncome($id, $dataInicial, $dataFinal);

        return $incomeCusteio - $expenditureCusteio;
    }

    public function previousBallance($id, $data){

        $expenditure = Expenditure::where('account_id', $id)
        ->Join('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->where('pays.date_pay','<', $data)
        ->sum('pays.value_paid');

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
        ->select('expenditures.*', 'pays.date_pay', 'pays.interest', 'pays.value_paid')
        ->orderBy('pays.date_pay', 'desc')
        ->get();
    }

    public function accountBySchool($id){
        $account = Account::where('school_id', $id)->paginate(25);
        return $account;
    }

    public function sumExpenditure($id, $dataInicial, $dataFinal){
        $expenditure = Expenditure::where('account_id', $id)
        ->Join('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->where('pays.date_pay','>=', $dataInicial)->where('pays.date_pay', '<=', $dataFinal)
        ->sum('pays.value_paid');

        return $expenditure;
    }

    public function sumExpenditureNature($id, $dataFinal, $nature){
        $expenditure = Expenditure::where('account_id', $id)
        ->Join('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->where('pays.date_pay','<=', $dataFinal)
        ->where('expenditures.nature', '=', $nature)
        ->sum('pays.value_paid');

        return $expenditure;
    }

    public function sumIncome($id, $dataInicial, $dataFinal){
        $income = Income::where('account_id', $id)
        ->where('date_income','>=', $dataInicial)->where('date_income', '<=', $dataFinal)
        ->sum('amount');

        return $income;
    }

    public function sumIncomeNature($id, $dataFinal, $value_nature){
        $income = Income::where('account_id', $id)
        ->where('date_income','<=', $dataFinal)
        ->sum($value_nature);

        return $income;
    }

    public function sumBankIncome($id, $dataInicial, $dataFinal){
        $bankIncome = BankIncome::where('account_id', $id)
        ->where('date_bank_income','>=', $dataInicial)->where('date_bank_income','<=', $dataFinal)
        ->sum('value');

        return $bankIncome;
    }
}

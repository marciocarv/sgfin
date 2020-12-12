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

    public function bankIncome(){
        return $this->hasMany(BankIncome::class);
    }

    public function expenditures(){
        return $this->hasMany(Expenditure::class);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'value',
        'nature',
        'fixed'
    ];

    protected $dates = [
        'date_expenditure',
        'expiration',
    ];

    public function expenditureByAccount($id, $dataInicial, $dataFinal){
        $expenditures = Expenditure::where('account_id', $id)
        ->leftJoin('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->where('date_expenditure', '>=', $dataInicial)->where('date_expenditure', '<=', $dataFinal)
        ->select('expenditures.*', 'pays.id as pay_id', 'pays.date_pay')
        ->orderBy('expenditures.expiration', 'desc')
        ->paginate(25);

        return $expenditures;
    }

    public function PendingExpenditureBySchool($id){
        $expenditures = Account::where('accounts.school_id', $id)
        ->Join('expenditures', 'expenditures.account_id', '=', 'accounts.id')
        ->leftJoin('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->where('pays.id', '=', NULL)
        ->orderBy('expenditures.expiration', 'asc')
        ->limit(5)
        ->get();
        return $expenditures;
    }

    public function expendituresPaid($id, $dataInicial, $dataFinal){
        return Expenditure::where('account_id', $id)
        ->join('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->join('providers', 'providers.id', '=', 'expenditures.provider_id')
        ->where('pays.date_pay', '>=', $dataInicial)->where('pays.date_pay', '<=', $dataFinal)
        ->orderBy('pays.date_pay', 'asc')
        ->get();
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function pay(){
        return $this->hasOne(Pay::class);
    }
}

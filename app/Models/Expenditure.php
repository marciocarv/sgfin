<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripton',
        'value',
        'nature',
        'fixed'
    ];

    protected $dates = [
        'date_expenditure',
        'expiration',
    ];

    public function expenditureByAccount($id){
        $expenditures = Expenditure::where('account_id', $id)
        ->leftJoin('pays', 'pays.expenditure_id', '=', 'expenditures.id')
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

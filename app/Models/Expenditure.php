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
        'type'
    ];

    protected $dates = [
        'date_expenditure',
        'expiration',
    ];

    public function expensivesByAccount($id){
        $expenditures = Income::where('account_id', $id)
        ->join('ordinances', 'incomes.ordinance_id', '=', 'ordinances.id')
        ->where('incomes.account_id', '=', $id)
        ->select('incomes.*', 'ordinances.number', 'ordinances.description as orddescription')
        ->paginate(25);

        dd();
        //return $incomes;

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

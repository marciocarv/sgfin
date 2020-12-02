<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'value_custeio',
        'value_capital',
        'amount'
    ];

    protected $dates = [
        'date_income',
    ];

    public function ordinance(){
        return $this->belongsTo(Ordinance::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function incomeByAccount($id){
        $incomes = Income::where('account_id', $id)
        ->join('ordinances', 'incomes.ordinance_id', '=', 'ordinances.id')
        ->select('incomes.*', 'ordinances.number', 'ordinances.description as orddescription')
        ->paginate(25);
        return $incomes;

        /*$incomes = DB::table('incomes')
            ->join('ordinances', 'incomes.ordinance_id', '=', 'ordinances.id')
            ->where('incomes.account_id', '=', $id)
            ->select('incomes.*', 'ordinances.number', 'ordinances.description as orddescription')
            ->paginate(25);
        return $incomes;*/
    }
}

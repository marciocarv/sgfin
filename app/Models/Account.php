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

    public function accountBySchool($id){
        $account = Account::where('school_id', $id)->paginate(25);
        return $account;
    }
}

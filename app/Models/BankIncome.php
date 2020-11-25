<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
    ];

    protected $dates = [
        'date_bank_income',
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}

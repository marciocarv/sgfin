<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedExpenditure extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'provider_id',
        'descripton',
        'value',
        'nature',
        'reference_month'
    ];

    protected $dates = [
        'emission_date',
        'expiration_date',
    ];

    function fixedExpendituresBySchool($id){
        return FixedExpenditure::where('school_id', $id)->paginate(25);
    }
}

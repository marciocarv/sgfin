<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedExpenditure extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
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

    public function fixedExpendituresBySchool($id){
        return FixedExpenditure::where('account_id', $id)->paginate(25);
    }

    public function fixedBySchool($id, $data, $ref_month){
        return FixedExpenditure::where('school_id', $id)->where('emission_date', '<=', $data)->where('reference_month', '=', $ref_month)->first();
    }
}

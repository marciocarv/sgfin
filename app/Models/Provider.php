<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'cpf',
        'cnpj',
        'phone',
        'adress',
        'person_type',
    ];

    public function expenditures(){
        return $this->hasMany(Expenditure::class);
    }

    public function pendingExpenditures($id){
        return Expenditure::where('provider_id', $id)
        ->leftJoin('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->where('pays.id', '=', NULL)
        ->orderBy('expenditures.expiration', 'asc')
        ->get();
    }

    public function expendituresPaid($id){
        return Expenditure::where('provider_id', $id)
        ->join('pays', 'pays.expenditure_id', '=', 'expenditures.id')
        ->orderBy('pays.date_pay', 'asc')
        ->get();
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function providerBySchool($id){
        $providers = Provider::where('school_id', $id)->paginate(25);
        return $providers;
    }
}

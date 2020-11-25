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

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function providerBySchool($id){
        $providers = Provider::where('school_id', $id)->paginate(25);
        return $providers;
    }
}

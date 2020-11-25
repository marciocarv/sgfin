<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'associacao',
        'codigo_inep',
        'email',
        'telefone',
        'presidente',
        'secretario',
        'caf',
        'modulo',
        'cnpj',
        'adress',
        'cep',
        'lei_criation',
        'autorizacao_funcionamento',
        'image_lei',
    ];

    protected $dates = [
        'date_criacao',
    ];

    public function tenancys(){
        return $this->hasMany(Tenancy::class);
    }

    public function ordinances(){
        return $this->hasMany(Ordinance::class);
    }

    public function accounts(){
        return $this->hasMany(Account::class);
    }

    public function providers(){
        return $this->hasMany(Provider::class);
    }
}

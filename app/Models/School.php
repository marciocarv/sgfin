<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cnpj',
        'adress',
        'cep',
        'lei_criation',
        'image_lei'
    ];

    public function tenancy(){
        return $this->hasMany(Tenancy::class);
    }

    public function ordinance(){
        return $this->hasMany(Ordinance::class);
    }

    public function account(){
        return $this->hasMany(Account::class);
    }
}

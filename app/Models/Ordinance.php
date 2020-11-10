<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordinance extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'description',
        'number_diario',
        'nature',
        'font',
        'image',
        'value_custeio',
        'value_capital',
        'amount'
    ];

    protected $dates = [
        'date_ordinance',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function bidding(){
        return $this->hasMany(Bidding::class);
    }

    public function income(){
        return $this->hasMany(Income::class);
    }
}

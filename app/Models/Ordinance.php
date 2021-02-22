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
        'number_process',
        'number_diario',
        'nature',
        'source',
        'image',
        'amount'
    ];

    protected $dates = [
        'date_ordinance',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function bidding(){
        return $this->hasOne(Bidding::class);
    }

    public function incomes(){
        return $this->hasMany(Income::class);
    }

    public function ordinanceBySchool($id){

        $ordinances = Ordinance::where('school_id', $id)
        ->where('number', '<>', '0')
        ->where('number', '<>', '1')
        ->paginate(25);
        return $ordinances;
    }
}

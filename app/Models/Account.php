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

    public function income(){
        return $this->hasMany(Income::class);
    }

    public function expenditure(){
        return $this->hasMany(Expenditure::class);
    }
}

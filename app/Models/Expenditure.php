<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripton',
        'value',
    ];

    protected $dates = [
        'expiration',
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function pay(){
        return $this->hasMany(Pay::class);
    }
}

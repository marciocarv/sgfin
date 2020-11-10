<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'value',
    ];

    public function ordinance(){
        return $this->belongsTo(Ordinance::class);
    }

    public function account(){
        return $this->belongsTo(Account::class);
    }
}

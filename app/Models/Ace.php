<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ace extends Model
{
    protected $fillable = [
        'presidente',
        'vice_presidente',
        'secretario',
        'segundo_secretario',
        'tesoureiro',
        'segundo_tesoureiro',
        'membro_1',
        'membro_2',
        'membro_3'
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    use HasFactory;
}

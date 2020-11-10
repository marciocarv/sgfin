<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_process',
        'object',
        'tipe'
    ];

    public function ordinance(){
        return $this->belongsTo(Ordinance::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccFormat extends Model
{
    use HasFactory;

    protected $filable = [
        'description',
        'type'
    ];

    protected $dates = [
        'initial_date',
        'final_date',
    ];

    public function accountability(){

        return $this->belongsTo(Accountability::class);
    }
}

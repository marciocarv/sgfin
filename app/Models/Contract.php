<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_contract',
        'description',
        'object',
        'value',
    ];

    protected $dates = [
        'start_period',
        'end_period',
    ];
}

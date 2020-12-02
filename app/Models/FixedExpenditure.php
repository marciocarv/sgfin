<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedExpenditure extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'provider_id',
        'descripton',
        'value',
        'nature',
    ];

    protected $dates = [
        'emission_date',
        'expiration_date',
    ];
}

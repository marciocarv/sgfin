<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_invoice',
        'payment_method',
    ];

    protected $date = [
        'date_pay',
        'emission_invoice',
    ];

    protected $dateFormat = 'd/m/Y';

    public function expenditure(){
        return $this->belongsTo(Expenditure::class);
    }
}

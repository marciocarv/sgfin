<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_invoice',
        'image_invoice',
        'value',
    ];

    protected $date = [
        'date_pay',
    ];

    public function expenditure(){
        return $this->belongsTo(Expenditure::class);
    }
}

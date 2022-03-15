<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'unitary_value',
        'quantity',
        'total_value',
        'unity'
    ];

    public function contract(){
        return $this->belongsTo(Contract::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot(['quantity']);
    }

}

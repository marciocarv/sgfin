<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_contract',
        'category',
        'description',
        'object',
        'value',
        'nature'
    ];

    protected $dates = [
        'start_period',
        'end_period',
    ];

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}

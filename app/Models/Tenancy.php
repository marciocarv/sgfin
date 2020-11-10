<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'module',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

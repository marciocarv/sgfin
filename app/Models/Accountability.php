<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accountability extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_process',
        'description',
        'year'
    ];

    public function accountabilityBySchool($id){

    }
}

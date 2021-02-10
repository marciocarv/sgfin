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
        'year',
        'format'
    ];

    public function accountabilityBySchool($id, $year){
        return Accountability::where('accounts.school_id', $id)
        ->Join('accounts', 'accountabilities.account_id', '=', 'accounts.id')
        ->where('accountabilities.year', '=', $year)
        ->select('accountabilities.*')
        ->get();
    }
}

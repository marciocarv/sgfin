<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'responsible',
        'amount',
        'status'
    ];

    protected $dates = [
        'date_order'
    ];

    public function contract(){
        return $this->belongsTo(Contract::class);
    }

    public function items(){
        return $this->belongsToMany(Item::class)->withPivot(['quantity']);
    }

    public function orderByContract($id){
        return $this::Where('contract_id', $id)->where('status', 'aberto')->get();
    }
}

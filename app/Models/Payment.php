<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id','payment_method','bank_name','account_number','qris_ref','payment_status','paid_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}


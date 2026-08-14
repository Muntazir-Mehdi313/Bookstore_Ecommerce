<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', //[cite: 17]
        'user_id', //[cite: 17]
        'stripe_session_id', //[cite: 17]
        'payment_intent_id', //[cite: 17]
        'amount', //[cite: 17]
        'currency', //[cite: 17]
        'payment_status', //[cite: 17]
        'payment_method', //[cite: 17]
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
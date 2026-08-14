<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'receiver_name',
        'receiver_email',
        'receiver_phone',
        'receiver_address',
        'total_amount',
        'payment_method',
        'status',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items associated with the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
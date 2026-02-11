<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'total_amount',
        'status',
        'pincode',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

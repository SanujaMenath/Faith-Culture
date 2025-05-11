<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Order.php
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    protected $fillable = [
        'user_id',
        'inventory_id',
        'email',
        'telephone',
        'quantity',
        'price',
        'payment_status',
        'shipping_address',
        'special_instructions',
    ];
}

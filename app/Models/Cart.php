<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'inventory_id', 'quantity'];
    use HasFactory;

    // Optional: Add relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }




}

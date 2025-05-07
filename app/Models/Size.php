<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
public function inventories()
{
    return $this->hasMany(Inventory::class);
}

    public $timestamps = false;
    protected $fillable = ['name'];
    use HasFactory;
}

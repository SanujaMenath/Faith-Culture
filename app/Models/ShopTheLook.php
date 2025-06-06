<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopTheLook extends Model
{
     protected $table = 'shop_the_look';

    protected $fillable = [
    'model_image',
    'top_image',
    'top_product_link',
    'trouser_image',
    'trouser_product_link',
];

}

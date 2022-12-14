<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartProduct extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'product_id',
        'cart_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cartItems extends Model
{
    protected $fillable = ['cart_id', 'product_id' , 'quantity'];
}

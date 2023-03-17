<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'orders_id',
        'product_id',
        'product_title',
        'quantity',
        'price',
        'image'
    ];
}

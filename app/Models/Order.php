<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table= 'orders';
    protected $fillable = [
        'user_id',
        'cart',
        'products',  // JSON array of product IDs
        'order_products',  // JSON object mapping product IDs to their attributes
        'quantity',
        'address',
        'tip',
        'delivery_fee',
        'discounted_delivery_fee',
        'handling_fee',
        'discounted_handling_fee',
        'small_cart_fee',
        'discounted_small_cart_fee',
        'savings',
        'coupon',
        'coupon_discounted',
        'grand_total',
        'total_pay',
    ];
}

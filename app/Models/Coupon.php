<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table= 'coupons';
    protected $fillable = [
        'name',
        'code',
        'slug',
        'status',
        'start_date',
        'end_date',
        'type',
        'desc',
        'brands',
        'products',
        'users',
        'value',
        'min_value',
    ];
    
}

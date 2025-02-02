<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'rating',
        'feedback',
        'photos',
    ];

    protected $casts = [
        'photos' => 'array', // Automatically cast JSON column to array
    ];


    public function user()
{
    return $this->belongsTo(User::class);
}

public function order()
{
    return $this->belongsTo(Order::class);
}
  
}

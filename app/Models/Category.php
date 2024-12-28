<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table= 'categories';
    protected $fillable = [
        'name',       // Add 'name' to the fillable array
        'description', // Add other fields as needed
        'status',
        'slug',
    ];
}

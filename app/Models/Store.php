<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table='stores';
    protected $fillable= ['user_id','name','address','latitude','longitude','slug','status'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'gender',
        'status',
        'role',
        'password',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean', // 0 or 1 for inactive/active
        'password' => 'hashed',
    ];

    /**
     * Get the role of the user in a human-readable format.
     *
     * @return string
     */
    public function getRoleLabel(): string
    {
        return ucfirst($this->role);
    }
    
     public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}

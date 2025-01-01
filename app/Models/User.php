<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'cin',
        'adresse',
        'tel',
        'email',
        'password',
        'role',
        'google_id',
        'status',
        'pays','
        ville',
        'codepostal'
    ];

public function sendPasswordResetNotification($token)
{
    $this->notify(new CustomResetPassword($token));
}


    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }
    public function isLivreur()
    {
        return $this->role === 'livreur';
    }

    public function cartItems()
    {
        return $this->hasManyThrough(CartItems::class, Carts::class, 'user_id', 'cart_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function Commandes(){
        return $this->hasMany(Commandes::class);
    }
    public function Carts(){
        return $this->hasMany(Carts::class);
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

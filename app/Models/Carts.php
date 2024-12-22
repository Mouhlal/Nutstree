<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carts extends Model
{
    use HasFactory , SoftDeletes ;

    protected $guarded = [] ;

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(CartItems::class, 'cart_id');
    }
    public function getTotalAfterDiscount()
{
    return $this->total_price - $this->discount;
}
}

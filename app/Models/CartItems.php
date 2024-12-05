<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItems extends Model
{
    use HasFactory , SoftDeletes ;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Produits::class, 'produit_id');
    }

    public function cart()
    {
        return $this->belongsTo(Carts::class, 'cart_id');
    }
}

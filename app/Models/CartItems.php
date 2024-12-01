<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItems extends Model
{
    use HasFactory , SoftDeletes ;

    protected $guarded = [];

    public function Carts(){
        return $this->belongsTo(Carts::class);
    }
    public function Produits(){
        return $this->belongsTo(Produits::class);
    }
}

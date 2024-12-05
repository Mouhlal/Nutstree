<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produits extends Model
{
    use HasFactory , SoftDeletes ;

    protected $guarded = [] ;

    public function Categories(){
        return $this->belongsTo(Categorie::class);
    }
    public function CartItems(){
        return $this->hasMany(CartItems::class);
    }
    public function Commandes_produits(){
        return $this->hasMany(Commandes_produits::class);
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'produit_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commandes extends Model
{
    use HasFactory , SoftDeletes ;

    protected $guarded = [] ;

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Commandes_produits(){
        return $this->hasMany(Commandes_produits::class);
    }
    public function Paiements(){
        return $this->hasOne(Paiements::class);
    }
    public function products()
    {
    return $this->belongsToMany(Produits::class, 'commandes_produits', 'commande_id', 'produit_id')
                ->withPivot('quantity', 'prix')  ->withTimestamps();;
    }
   
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commandes_produits extends Model
{
    use HasFactory , SoftDeletes ;

    protected $guarded = [] ;

    public function Commandes(){
        return $this->belongsTo(Commandes::class);
    }
    public function Produits(){
        return $this->belongsTo(Produits::class);
    }
}

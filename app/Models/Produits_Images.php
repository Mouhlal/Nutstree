<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produits_Images extends Model
{
    use HasFactory ;
    protected $guarded = [] ;

    public function products(){
        return $this->belongsTo(Produits::class,'produit_id');
    }
}

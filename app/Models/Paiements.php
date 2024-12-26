<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paiements extends Model
{
    use HasFactory , SoftDeletes ;

    protected $fillable = [
        'commande_id',
        'amount',
        'payment_method',  // Utilisez 'payment_method' en snake_case
        'transaction_id',
        'payment_intent_id',
        'status'
    ];

    public function Commandes(){
        return $this->belongsTo(Commandes::class);
    }
    protected $table = 'paiements';


}

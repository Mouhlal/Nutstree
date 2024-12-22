<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code_Promo extends Model
{
    use HasFactory , SoftDeletes ;

    protected $fillable = ['code', 'discount', 'expires_at'];

    public function isValid()
    {
        return $this->expires_at ? $this->expires_at->isFuture() : true;
    }
}

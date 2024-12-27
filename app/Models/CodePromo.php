<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodePromo extends Model
{

    protected $table = 'code_promo';
    protected $guarded = [];

    public function isValid()
    {
        return $this->valid_until >= now() && $this->status === 1;
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $guarded = [];

    public function getPenghasilanAttribute($value)
    {
        return number_format($value, 0, ',', '.');
    }
}

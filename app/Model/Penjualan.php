<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $guarded = [];

    // relation
    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    protected $fillable = ['jenis_sampah', 'berat'];

    // Relasi
    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penyetoran extends Model
{
    protected $fillable = ['user_id', 'jenis_sampah', 'berat', 'penghasilan'];

    // Relasi
    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }
}

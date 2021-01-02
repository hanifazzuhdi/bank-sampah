<?php

namespace App\Model;

use App\Traits\FormatDate;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use FormatDate;

    protected $fillable = ['jenis_sampah', 'berat'];

    // Relasi
    public function jenis()
    {
        return $this->belongsTo('App\Model\Jenis', 'jenis_sampah', 'id');
    }
}

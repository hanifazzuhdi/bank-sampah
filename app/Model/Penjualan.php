<?php

namespace App\Model;

use App\Traits\FormatDate;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use FormatDate;

    protected $fillable = ['jenis_sampah', 'berat', 'harga', 'penghasilan'];

    // relation
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_sampah');
    }
}

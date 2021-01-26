<?php

namespace App\Model;

use App\Traits\FormatDate;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use FormatDate;

    protected $fillable = ['jenis_sampah', 'image', 'harga', 'warna'];

    // relasi
    public function penyetoran()
    {
        return $this->hasMany(Penyetoran::class);
    }

    public function sampah()
    {
        $this->hasOne('App\Model\Sampah', 'jenis_sampah', 'id');
    }
}

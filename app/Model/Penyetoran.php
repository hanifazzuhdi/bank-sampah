<?php

namespace App\Model;

use App\Traits\FormatDate;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Penyetoran extends Model
{
    use FormatDate;

    protected $fillable = ['user_id', 'jenis_sampah', 'berat', 'penghasilan'];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_sampah');
    }
}

<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $fillable = ['keterangan', 'jenis_sampah', 'berat', 'debet', 'kredit', 'saldo', 'user_id'];

    // Accessor
    public function getSaldoAttribute($value)
    {
        return number_format($value, 0, ',', '.');
    }

    // Relation
    public function user()
    {
        return $this->hasOne(User::class);
    }
}

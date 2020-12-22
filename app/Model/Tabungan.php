<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $fillable = ['keterangan', 'jenis_sampah', 'berat', 'debet', 'kredit', 'saldo', 'user_id'];
}

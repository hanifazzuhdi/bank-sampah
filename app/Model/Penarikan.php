<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $table = 'penarikan';

    protected $fillable = ['user_id', 'nama', 'rekening', 'keterangan', 'kredit', 'saldo'];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $fillable = ['saldo','debet','kredit','keterangan'];
}

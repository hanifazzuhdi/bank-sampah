<?php

namespace App\Model;

use App\Traits\FormatDate;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use FormatDate;

    protected $fillable = ['saldo', 'debit', 'kredit', 'keterangan'];
}

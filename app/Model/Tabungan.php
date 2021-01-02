<?php

namespace App\Model;

use App\User;
use App\Traits\FormatDate;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use FormatDate;

    protected $fillable = ['keterangan', 'jenis_sampah', 'berat', 'debet', 'kredit', 'saldo', 'user_id', 'status'];

    // Relation
    public function user()
    {
        return $this->hasOne(User::class);
    }
}

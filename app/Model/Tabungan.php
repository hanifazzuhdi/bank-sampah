<?php

namespace App\Model;

use App\User;
use App\Traits\FormatDate;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use FormatDate;

    protected $fillable = ['keterangan', 'debit', 'kredit', 'saldo', 'user_id', 'status'];

    // Relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Model;

use App\Traits\FormatDate;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $table = 'penarikan';

    protected $fillable = ['user_id', 'nama', 'rekening', 'keterangan', 'kredit', 'saldo', 'status'];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l d M Y');
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

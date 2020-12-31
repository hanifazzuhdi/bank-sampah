<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    protected $fillable = ['jenis_sampah', 'berat'];


    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('d, F Y H:i');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->diffForHumans();
    }

    // Relasi
    public function jenis()
    {
        return $this->belongsTo('App\Model\Jenis', 'jenis_sampah', 'id');
    }
}

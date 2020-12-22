<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $fillable = ['jenis_sampah', 'harga'];
}

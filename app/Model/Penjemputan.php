<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    protected $fillable = ['user_id', 'image', 'address', 'phone_number', 'description', 'status'];
    public function user()
    {
        return $this->belongsTo('App\User', 'User_id', 'id');
    }
}

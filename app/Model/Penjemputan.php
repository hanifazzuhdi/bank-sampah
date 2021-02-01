<?php

namespace App\Model;

use App\Traits\FormatDate;
use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    use FormatDate;

    protected $fillable = ['user_id', 'image', 'address', 'phone_number', 'description', 'status'];

    // relation
    public function user()
    {
        return $this->belongsTo('App\User', 'User_id', 'id');
    }
}

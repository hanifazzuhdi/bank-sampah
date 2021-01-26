<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class hargasampah extends Model
{
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('H:i');
    }   
    protected $guarded = [];
}

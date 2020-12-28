<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Relation
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

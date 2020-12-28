<?php

namespace App;

use App\Model\Role;
use App\Model\Tabungan;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'avatar', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Relation
    public function tabungans()
    {
        return $this->hasMany(Tabungan::class);
    }

    public function penjemputan()
    {
        return $this->belongsTo('App\Api\Penjemputan', 'User_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

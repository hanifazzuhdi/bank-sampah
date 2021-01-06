<?php

namespace App;

use App\Model\Penarikan;
use App\Model\Penyetoran;
use App\Model\Role;
use App\Model\Tabungan;
use App\Traits\FormatDate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    use FormatDate;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'avatar', 'address', 'role_id'
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

    public function getDeletedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['deleted_at'])
            ->translatedFormat('d F Y H:i');
    }

    // Relation
    public function penyetoran()
    {
        return $this->hasMany(Penyetoran::class);
    }

    public function penarikan()
    {
        return $this->hasMany(Penarikan::class);
    }

    public function tabungans()
    {
        return $this->hasMany(Tabungan::class);
    }

    public function penjemputan()
    {
        return $this->belongsTo('App\Api\Penjemputan', 'User_id', 'id');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
}

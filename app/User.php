<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'gender', 'birthday', 'email', 'password', 'phone', 'street', 'province_id', 'district_id', 'ward_id', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    public function province()
    {
        return $this->belongsTo('App\Province');
    }
    public function district()
    {
        return $this->belongsTo('App\District');
    }
    public function ward()
    {
        return $this->belongsTo('App\Ward');
    }
}

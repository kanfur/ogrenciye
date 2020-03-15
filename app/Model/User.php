<?php

namespace App\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name','surname','about','birthday','phone', 'email', 'password','photo','isVerified'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function restaurants(){
        return $this->hasMany(Restaurant::class);
    }
    public function education(){
        return $this->hasOne(Education::class);
    }
    public function isStudent(){
        //TODO confirmed kontrolü yapılmalı
        if($this->education()->count()){
            return true;
        }
        return false;
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}

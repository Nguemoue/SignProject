<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Administrateur extends Authenticable
{
    use HasFactory,Notifiable,MustVerifyEmail, Authenticatable;

    protected $fillable = [
        'nom',
        'email',
        'password',
        'telephone'
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function scopeIsActive($query){
        return $query->where('is_active',1);
    }

    protected $hidden = [
        'password',
        'remember_token'
    ];

}

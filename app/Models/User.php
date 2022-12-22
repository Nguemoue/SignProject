<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    function coordBank(){
        return $this->hasOne(CoordBancaire::class);
    }

    function adresse(){
        return $this->hasOne(Adresse::class)->withDefault([
            'pays'=>'Canada',
            'quartier'=>'re 23 ',
            'boitePostal'=>'bp 102',
            'ville'=>'quebec',
            'zip'=>'03',
            'district'=>'muschingana',
            'numeroRue'=>'201'
        ]);
    }

    function commandes(){
        return $this->hasMany(Commande::class);
    }


}

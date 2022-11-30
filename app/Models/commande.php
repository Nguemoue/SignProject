<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','prix'
    ];
    function commandeProduits(){
        return $this->hasMany(CommandeProduit::class);
    }

    function produits(){
        return $this->belongsToMany(Produit::class,'commande_produits');
    }
}

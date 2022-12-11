<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;

class commande extends Model
{
    use HasFactory , SerializesModels;

    protected $fillable = [
        'user_id','prix','prixTtc'
    ];
    function commandeProduits(){
        return $this->hasMany(CommandeProduit::class);
    }

    function produits(){
        return $this->belongsToMany(Produit::class,'commande_produits');
    }
}

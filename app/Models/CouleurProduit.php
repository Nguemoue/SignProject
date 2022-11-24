<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouleurProduit extends Model
{
    use HasFactory;
    function produits(){
        return $this->belongsTo(Produit::class);
    }

    function nbProduits(){
        return Produit::query()->where('id',$this->produit_id)->count();
    }
}

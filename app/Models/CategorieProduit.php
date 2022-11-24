<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieProduit extends Model
{
    use HasFactory;
    function produits(){
        return  $this->hasMany(Produit::class);
    }
    function nbProduits(){
        return $this->hasMany(Produit::class)->count();
    }
}

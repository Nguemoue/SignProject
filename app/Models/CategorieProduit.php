<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieProduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom','description','image'
    ];
    function produit(){
        return  $this->hasOne(Produit::class,'categorie_produit_id');
    }
    function nbProduits(){
        return $this->hasMany(Produit::class)->count();
    }
}

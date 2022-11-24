<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    function couleur(){
        return $this->hasMany(CouleurProduit::class);
    }

    function specification(){
        return $this->hasOne(SpecificationProduit::class);
    }
    function categorie(){
        return $this->belongsTo(CategorieProduit::class);
    }

    function marque(){
        return $this->hasOne(MarqueProduit::class);
    }

    function images(){
        return $this->hasMany(PhotoProduit::class);
    }

    function comments(){
        return $this->hasMany(Comment::class);
    }

    protected $casts = [
        'prix'=>'float'
    ];
}

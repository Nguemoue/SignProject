<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom','description','quantite','prix','categorie_produit_id'
    ];
    function couleur(){
        return $this->hasMany(CouleurProduit::class);
    }

    function specification(){
        return $this->hasOne(SpecificationProduit::class)->withDefault([
             'width'=>1,'height'=>1 ,'depth'=>1, 'weight'=>1 ,'consigne'=>'ne pas geter' ,'peremtion'=>now()
        ]);
    }
    function categorie(){
        return $this->belongsTo(CategorieProduit::class,'categorie_produit_id');
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

<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarqueProduit extends Model
{
    use HasFactory;
    function produits()
    {
        return $this->belongsTo(Produit::class,'produit_id',);
    }

    
    function nbProduits()
    {
        return Produit::query()->where("id", $this->produit_id)->count();

    }
}

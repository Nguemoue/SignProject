<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeProduit extends Model
{
    use HasFactory;
    protected $fillable = [
        'produit_id','quantite','commande_id'
    ];

    function produit(){
        return $this->belongsTo(Produit::class);
    }

}

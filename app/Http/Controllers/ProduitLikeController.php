<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;

class ProduitLikeController extends Controller
{

    function like(Request $request,Produit $produit){
        dd($produit,auth()->user());
    
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CategorieProduit;
use App\Models\Produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home(){
        $categories = CategorieProduit::query()->orderBy("id","asc")->take(3)->get();
        $mostLiked = Produit::query()->join("like_produits", "produits.id", "=", "like_produits.produit_id")->groupBy("produit_id","produits.id","produits.nom","produits.prix")
        ->selectRaw("count(produit_id) as nb_like")->addSelect("produits.id","produits.nom","produits.prix")
        ->orderBy("nb_like","desc")
        ->take(8)->get();
        // dd($mostLiked);
        return view('welcome',compact('categories','mostLiked'));
    }

    function acceuil(){
        return view('acceuil');
    }
    function dashboard(){
        return view("dashboard");
    }
}

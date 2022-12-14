<?php

namespace App\Http\Controllers;

use App\Models\CategorieProduit;
use App\Models\Post;
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
        
        $mostSell = Produit::query()->join("commande_produits","commande_produits.produit_id","=","produits.id")->groupBy("produit_id","produits.id", "produits.nom", "produits.prix")
        ->selectRaw("count(produit_id) as nb_sell ")->addSelect("produits.id", "produits.nom", "produits.prix")
        ->orderBy("nb_sell","desc")->take(8)->get();
        
        $latestBlogs = Post::query()->orderBy("id", "desc")->take(3)->get();
        // dd($mostSell);
        // dd($mostLiked);
        return view('welcome',compact('categories','mostLiked','mostSell',"latestBlogs"));
    }

    function acceuil(){
        return view('acceuil');
    }
    function dashboard(){
        return view("dashboard");
    }
}

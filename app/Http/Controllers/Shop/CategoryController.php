<?php

namespace App\Http\Controllers\Shop;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\MarqueProduit;
use App\Models\CouleurProduit;
use App\Models\CategorieProduit;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function __invoke(Request $request)
    {
        
        $perPage = 10;
        $categorieFilter = $request->query('categorie');
        $currentCat = $categorieFilter;
        $nbProduits = Produit::query()->count();
        $categorieFilter = CategorieProduit::query()->where("nom","=",$categorieFilter)->pluck('id')->first();        
     
        $produits = Produit::query()->with('categorie')->when($categorieFilter,function($query) use($categorieFilter,$perPage){
             $query->where("categorie_produit_id",$categorieFilter)->with('categorie')->paginate($perPage);
        })->paginate($perPage);
     
        $categories = CategorieProduit::query()->withExists(["produits"])->withCount("produits")->get();
     
        $marques = MarqueProduit::query()->with("produits")->get();
        $couleurs = CouleurProduit::query()->with("produits")->get();
        
        return view("shop.category",compact("produits","categories","nbProduits","couleurs","marques","currentCat"));
    }
}

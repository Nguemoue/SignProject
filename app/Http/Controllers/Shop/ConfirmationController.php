<?php

namespace App\Http\Controllers\Shop;

use App\Events\CartCheckoutEvent;
use App\Http\Controllers\Controller;
use App\Models\commande;
use App\Models\Produit;
use App\Notifications\CartCheckoutNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfirmationController extends Controller
{

    function __invoke(Request $request)
    {
        return $this->giveView();
    }


    // fonction qui va me permettre d'ajouter une nouvelle commande et de la confirmer
    function store(Request $request){
        
        $storedProducts = session()->get('panier.produits');
        $prix = 0;
        $arr = [];
        foreach($storedProducts as $key => $value){
            $produit = Produit::find($key);
            $sousPrix = $produit->prix * $value;
            $arr[] = $produit->nom . " / " . Str::padLeft($value,2,'0') . " / " . $sousPrix;
            $prix = $prix + $sousPrix;
        }
        event(new CartCheckoutEvent($storedProducts));
        auth()->user()->notify(new CartCheckoutNotification(arr:$arr,prix:$prix));
        // dd($storedProducts);
        // je creer un evenement 
        return $this->giveView();
    }

    private function giveView(){
        // je selectionne tout les commande de l'utilisateur
        $commande = commande::query()->where('user_id',auth()->user()->id)->latest()->first();
        return view("shop.confirmation",compact("commande"));
    }
}

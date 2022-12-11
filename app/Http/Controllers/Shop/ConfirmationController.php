<?php

namespace App\Http\Controllers\Shop;

use App\Action\TaxeCalculator;
use App\Events\CartCheckoutEvent;
use App\Http\Controllers\Controller;
use App\Models\commande;
use App\Models\Produit;
use App\Notifications\CartCheckoutNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use stdClass;

class ConfirmationController extends Controller
{

    function __invoke(Request $request)
    {
        return $this->giveView();
    }


    // fonction qui va me permettre d'ajouter une nouvelle commande et de la confirmer
    function store(Request $request){
        
        $cart = session()->get('panier.produits');
        // j'emet un evenement de validation de carte
        event(new CartCheckoutEvent($cart));
        return $this->giveView();
    }

    private function giveView(){
        // je selectionne tout les commande de l'utilisateur
        $commande = commande::query()->where('user_id',auth()->user()->id)->latest()->first();
        return view("shop.confirmation",compact("commande"));
    }

    
}

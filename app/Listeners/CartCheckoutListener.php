<?php

namespace App\Listeners;

use App\Action\TaxeCalculator;
use App\Events\CartCheckoutEvent;
use App\Models\commande;
use App\Models\CommandeProduit;
use App\Models\Comment;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CartCheckoutListener
{

    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CartCheckoutEvent  $event
     * @return void
     */
    public function handle(CartCheckoutEvent $event)
    {
        //je recupere le arr
        $arr = $event->getArr();
        //je fais le traitement cad j'enregistrer les commandes en base de donnes 
        // je cree ma commande
        $prix = 0;
        foreach ($arr as $key => $value) {
            $produit = Produit::query()->find($key);
            $prix = $prix + ($produit->prix * $value);
            $prix+=TaxeCalculator::get($prix);
            //je creer ma commande
        }
        $commande = commande::query()->create([
            'user_id' => auth()->user()->id,
            'prix' => $prix,
        ]);
        //puis je vide ma sessions de commande
        foreach ($arr as $key => $value) {
            // j'ajoute dans ma commadeProduit
            $commandeProduit = CommandeProduit::query()->create([
                'produit_id'=>$key,
                'quantite'=>$value,
                'commande_id'=>$commande->id
            ]);

            // je supprime l'objet la de la session
            session()->forget('panier.produits.'.$key);
        }
    }
}

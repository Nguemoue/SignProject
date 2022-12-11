<?php

namespace App\Listeners;

use stdClass;
use App\Models\User;
use App\Models\Comment;
use App\Models\Produit;
use App\Models\commande;
use App\Action\TaxeCalculator;
use App\Models\CommandeProduit;
use App\Events\CartCheckoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\CartCheckoutNotification;

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
        }
        $taxe = TaxeCalculator::get($prix);
        $prixTtc = $prix+$taxe;
        $commande = commande::query()->create([
            'user_id' => auth()->user()->id,
            'prixTtc'=> $prixTtc,
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
        $this->sendNotification($commande);

    }

    private function sendNotification($commande)
    {
        // $detail = new stdClass;
        // $detail->prix = 0;
        // $detail->taxe = 0;
        // $detail->sousTotal = 0;
        // $detail->produits = [];
        // $detail->numCommade = '';
        // $detail->commande = $commande;

        // foreach ($cart as $key => $value) {
        //     $produit = Produit::find($key);
        //     $tmp = new stdClass;
        //     $tmp->nom = $produit->nom;
        //     $tmp->quantite = $value;
        //     $tmp->prix = $produit->prix;
        //     $tmp->sousTotal = $produit->prix * $value;;
        //     $detail->produits[] = $tmp;
        //     $detail->sousTotal += $detail->sousTotal;
        // }

        // $detail->taxe = TaxeCalculator::get($detail->sousTotal);
        // $detail->prix = $detail->prix +  $detail->taxe;

        auth()->user()->notify(new CartCheckoutNotification($commande));
    }
}

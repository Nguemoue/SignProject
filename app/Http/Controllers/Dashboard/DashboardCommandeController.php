<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\commande;
use Illuminate\Http\Request;
use App\Models\CommandeProduit;
use App\Http\Controllers\Controller;

class DashboardCommandeController extends Controller
{
    function index(){
        $result = ($this->getCommandePerYear());
        return view("users.commandes.index",[
            'commandesPerYear'=>$result
        ]);
    }


    function detail($id){
        $commande = Commande::query()->find($id);
        return view("users.commandes.detail", compact('commande'));
    }


















    private function getCommandePerYear(){
        $user_id = auth()->user()->id;

        $resultat = commande::query()->join("commande_produits", function ($query) {
            $query->on("commande_produits.commande_id", "=", "commandes.id");
        })->join("produits", function ($query) {
            $query->on("produits.id", "=", 'commande_produits.produit_id');
        })->groupByRaw("Year(commandes.created_at)")->where("commandes.user_id",$user_id)
        ->selectRaw("Year(commandes.created_at) as y,sum(commandes.prixTtc) as total")->get();

        $resultat->map(function ($elt) use($user_id) {
            // je selectionne les info du produit commande cette annees
            $elt->prix = "oui";
            $elts = Commande::query()->whereYear("commandes.created_at", "=", $elt->y)
                ->join("commande_produits", "commandes.id", "=", "commande_produits.commande_id")
                ->join("produits", "produits.id", "=", "commande_produits.produit_id")->where("commandes.user_id", $user_id)->get();
            $elt->infos = $elts;
        });

        return $resultat;

    }
}

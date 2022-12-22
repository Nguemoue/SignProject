<?php

namespace App\Http\Livewire\Users;

use App\Models\commande;
use App\Models\CommandeProduit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderStatistic extends Component
{
    public $totalAmount = 0;
    public $nbOrders = 0;

    public $orderPerCategories = [];

    function mount(){
        $details  = commande::query()->where("user_id", auth()->user()->id)
        ->selectRaw("sum(prixTtc) as total,count(id) as nb")->get();
        $this->totalAmount = $details->pluck("total")->first();
        $this->nbOrders = $details->pluck("nb")->first();

        $this->orderPerCategories = commande::query()->join("commande_produits", function ($query) {
            $query->on("commande_produits.commande_id", "=", "commandes.id");
        })->join("produits", function ($query) {
            $query->on("produits.id", "=", "commande_produits.produit_id");
        })->join("categorie_produits", function ($query) {
            $query->on("categorie_produits.id", "=", "produits.categorie_produit_id");
        })->groupBy("categorie_produits.nom")->selectRaw("categorie_produits.nom as cat_nom ,sum(commandes.prix) as price ,count(commande_produits.produit_id) as nb_produit ")
        ->where("commandes.user_id",auth()->user()->id)->get();
    }
    public function render()
    {
        $commands = $this->getStat();

        return view('livewire.users.order-statistic',compact("commands"));
    }

    private function getStat(){
        $user = auth()->user();
        $temp = CommandeProduit::query()->join("commandes", function ($query) {
            $query->on("commandes.id", "=", "commande_produits.commande_id");
        })->groupByRaw("Year(commande_produits.created_at),Month(commande_produits.created_at),commande_id")
            ->where("commandes.user_id", $user->id)
            ->selectRaw("commande_id, Year(commande_produits.created_at) as y,Month(commande_produits.created_at) as m ")->get("y","commande_id",'m')->toArray();
        // dd($temp);
        $orderPerYears = [];
        // code final
        foreach($temp as $key=>$value){
            // je verifie si l'annea est presente deja dans mon tableau
            if(array_key_exists($value['y'],$orderPerYears)){
                // si oui je regarde sur le moi
                // je recupere le tableau de l'annees
                $tempYear = &$orderPerYears[$value['y']];
                // je verifie si le mois en cours est dans ce tableau
                if(!array_key_exists($value['m'],$tempYear)){
                    // si le mois est present alors on upgrade 
                    $tempMonth = &$tempYear[$value['m']];
                    // je selectionne 
                    $tempCommande = Commande::find($value['commande_id']);
                    $tempMonth[] = $tempCommande;
                }else{
                    // sinon je cree mon nouveau commade et je
                    $tempCommande = commande::find($value['commande_id']);
                    $tempYear[$key['m']] = [$tempCommande];
                }
            }else{
                // sinon j'ajoute mon anne avec le mois courant puis je saute
                // ici l'anne n'existe pas
                //je recupere ma commande courante
                $tempCommande = commande::find($value['commande_id']);
                $orderPerYears[$value['y']] = [
                    $value['m']=>[$tempCommande]
                ];
            }
        }

        return $orderPerYears;


    }
}

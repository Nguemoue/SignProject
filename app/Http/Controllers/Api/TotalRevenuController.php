<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CommandeProduit;
use App\Http\Controllers\Controller;

class TotalRevenuController extends Controller
{


    function getRevenu(){
        // return '0';
        return $this->getTemplateForSerienInTotalRevenuJs();
    }

    function getTemplateForSerienInTotalRevenuJs()
    {
        $month = [];
        foreach (range(1, 12) as $v) {
            $month[$v] = $v;
        }

        $series = [];
        foreach ($this->getDepenseStat() as $key => $value) {
            $temp = [];
            $obj = new \Stdclass;
            $obj->name = $key;

            $temp = array_map(function ($c) use ($value) {
                if (in_array($c, array_keys($value))) {
                    $val = $value[key($value)];
                    return $val;
                } else {
                    return 0;
                }
            }, $month);

            $obj->data = $temp;
            $series[] = $obj;
        }
        return response($series);
    }


   private function getDepenseStat()
    {
        $user = auth("web")->user();
        $temp = CommandeProduit::query()->join("commandes", function ($query) {
            $query->on("commandes.id", "=", "commande_produits.commande_id");
        })->groupByRaw("Year(commande_produits.created_at),Month(commande_produits.created_at)")
            ->where("commandes.user_id", $user->id)
            ->selectRaw("sum(commandes.prixTtc) as prix, Year(commande_produits.created_at) as y,Month(commande_produits.created_at) as m ")->get("y", "prix", 'm')->toArray();
        // dd($temp);
        $orderPerYears = [];
        // code final
        foreach ($temp as $key => $value) {
            // je verifie si l'annea est presente deja dans mon tableau
            if (array_key_exists($value['y'], $orderPerYears)) {
                // si oui je regarde sur le moi
                // je recupere le tableau de l'annees
                $tempYear = & $orderPerYears[$value['y']];
                // je verifie si le mois en cours est dans ce tableau
                if (!array_key_exists($value['m'], $tempYear)) {
                    // si le mois est present alors on upgrade 
                    $tempMonth = & $tempYear[$value['m']];
                    // je selectionne 
                    $tempPrix = $value['prix'];
                    $tempMonth += $tempPrix;
                } else {
                    // sinon je cree mon nouveau commade et je
                    $tempPrix = $value['prix'];
                    $tempYear[$key['m']] = $tempPrix;
                }
            } else {
                // sinon j'ajoute mon anne avec le mois courant puis je saute
                // ici l'anne n'existe pas
                //je recupere ma commande courante
                $tempPrix = $value['prix'];
                $orderPerYears[$value['y']] = [
                    $value['m'] => $tempPrix
                ];
            }
        }
        return $orderPerYears;
    }

}
<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    function __invoke(Request $request)
    {
        // Session::forget("panier.count");
        //je verifie si la session existe
        $produits = Session::get('panier.produits',[]);
        $produits = Arr::map($produits,function($val,$key){
            $produit = Produit::find($key);
            $produit->nombre = $val;
            return ($produit);
        });
        return view('shop.cart',[
            'produits'=>$produits
        ]);
    }

    // fonction qui va s'occuper d'ajouter l'element dans le panier
    function index(Request $request){
        //je passe a la validation de mes entrees pour s'assurer que le produit existe en base de donnees et que la
        //quantite est correct
        $request->validate([
            'quantite'=>['required','integer','min:1'],
            'produitId'=>['required','integer','exists:produits,id']
        ],[
            "produitId"=>"le produit selectionner est temporairement indisponible"
        ]);

        // je recupere mes entrees dans des variables
        $produitId = $request->input("produitId");
        $quantite = (int) $request->input('quantite');

        //si mon panier n'existe pas je le creer
        if($currentQuantity = Session::get("panier.produits.$produitId")){
            Session::put("panier.produits.$produitId",$currentQuantity+$quantite);
        }else{
            Session::put("panier.produits.$produitId",$quantite);
        }

        return redirect()->route('shop.cart');
    }


    // fonction qui va peremetre de supprimer un element dans le panier
    function delete(Request $request){
        Validator::make($request->all(),[
            'produit_id'=>['required','integer','exists:produits,id']
        ]);

        //si on valide notre requete
        $id = $request->produit_id;
        //je supprime la donnes dans la session
        session()->forget('panier.produits.'.$id);
        return redirect()->back()->with("success","cet element a ete retirer du panier avec success");
    }
}

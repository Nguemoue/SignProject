<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductCheckoutController extends Controller
{
    function __invoke(Request $request)
    {
        return $this->giveView();
    }

    
    function checkout(Request $request)
    {
        $result = array_combine($request->produitIds, $request->produitQuantites);

        foreach ($result as $key => $val) {
            session()->put("panier.produits.$key", $val);
        }
        return $this->giveView();
    }
    private function giveView()
    {
        $result = session()->get('panier.produits');
        
        $produits = Arr::map($result, function ($val, $key) {
            $produit = Produit::find($key);
            $produit->nombre = Str::padLeft($val, 2, '0');
            $produit->total = $produit->prix * $produit->nombre;
            return $produit;
        });
        return view('shop.checkout', compact('produits'));
    }
}

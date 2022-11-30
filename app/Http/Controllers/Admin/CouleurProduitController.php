<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouleurProduit;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouleurProduitController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->only(['produit_id','nom','code']),[
            'produit_id'=>['required','integer'],
            'nom'=>['required','unique:couleur_produits,nom','string'],
            'code'=>['required']
        ])->validate();

        $produit = Produit::query()->findOrFail($request->integer('produit_id'));
        
        $produit->couleur()->save(CouleurProduit::query()->create([
            'produit_id'=>$request->integer('produit_id'),
            'nom'=>$request->input('nom'),
            'code'=>$request->input('code'),
        ]));
        return redirect()->back()->with('info',"la couleur {$request->nom } a ete  ajouter au produit");
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @param  \App\Models\CouleurProduit  $couleurProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit, CouleurProduit $couleurProduit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @param  \App\Models\CouleurProduit  $couleurProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(CouleurProduit $couleurProduit)
    {
        $couleurProduit->delete();
        return redirect()->back()->with('info',"couleur supprimer avec success");
    }
}

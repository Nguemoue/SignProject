<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategorieProduit;
use App\Models\Produit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $produits = \App\Models\Produit::paginate(10);
        return view('admin.produits.index',compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view("produits.create") ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(Produit $produit)
    {
        $categories = CategorieProduit::query()->get(['nom','id'])->toArray();
        return view("admin.produits.edit",compact("produit","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        $validatedData = $request->validate([
            'nom'=>'required|string',
            'quantite'=>'required|numeric',
            'prix'=>'required|numeric',
            'categorie_produit_id'=>'required|integer',
            'description'=>'required|string'
        ]);

        $res = $produit->update($validatedData);
        return redirect()->back()->with("info","les donnes sur le produit on ete correctement mis a jour");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

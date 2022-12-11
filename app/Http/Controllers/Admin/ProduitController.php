<?php

namespace App\Http\Controllers\Admin;

use App\Action\DecryptBase64File;
use App\Http\Controllers\Controller;
use App\Models\CategorieProduit;
use App\Models\PhotoProduit;
use App\Models\Produit;
use Composer\Util\Zip;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $produits = \App\Models\Produit::query()->orderBy('created_at','desc')->paginate(18);
        return view('admin.produits.index',compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $categories = CategorieProduit::all();
        return view("admin.produits.create",compact("categories")) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nom'=>['required','string','unique:produits,nom'],
            'prix'=>['required','numeric'],
            'quantite'=>['required','integer','min:1'],
            'description'=>['required','string'],
            'categorie_produit_id'=>['required','integer']
        ],[
            'categorie_produit_id'=>"erreur au niveau de la categorie du produit"
        ]);
        $produit = Produit::query()->create($validatedData);
        
        $stream = (DecryptBase64File::decrypt($request->imageHidden));
        $fileName = 'produits/' . $stream->name; 
        Storage::put($fileName,$stream->content);
        $produit->images()->save(PhotoProduit::query()->create([
            'photo'=> $fileName,
            'produit_id'=>$produit->id
        ]));
        return redirect()->route('admin.produits.index')->with('success', 'produit creer avec success !');
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
     * @param  \App\Models\Produit $produit
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

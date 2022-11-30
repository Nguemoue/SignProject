<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoProduit;
use App\Models\Produit;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //je valide mes dones
        Validator::make($request->only(['photo', 'produit_id']), [
            'photo' => ['required', 'image'],
            'produit_id' => ['required', 'integer']
        ])->validate();
        $produit = Produit::query()->find($request->input("produit_id"));
        if($produit == null){
            throw new ValidationException("aucun produit ne correspond a l'identifiant envoyer");
        }
        $photoProduit = PhotoProduit::query()->create([
            'photo'=>$request->file('photo')->store('produits'),
            'produit_id'=>$request->input('produit_id')
        ]); 
        $produit->images()->save($photoProduit);

        return redirect()->back()->with("info","Photo enregistrer avec success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhotoProduit  $photoProduit
     * @return \Illuminate\Http\Response
     */
    public function show(PhotoProduit $photoProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhotoProduit  $photoProduit
     * @return \Illuminate\Http\Response
     */
    public function edit(PhotoProduit $photoProduit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhotoProduit  $photoProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhotoProduit $photoProduit)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhotoProduit  $photoProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhotoProduit $photoProduit)
    {
        $photoProduit->delete();
        Storage::disk('public')->delete($photoProduit->photo);
        return redirect()->back()->with('info','photo retirer avec success');
    }

    function changePhoto(Request $request){
        // dd($request->file('photo'));
        $request->validate([
            'photo'=>['required','image'],
            'photo_id'=>['required','exists:photo_produits,id'],
            'produit_id'=>['required','exists:produits,id']
        ]);
        //

        $photo = PhotoProduit::query()->findOrFail($request->input('photo_id'));
        $photo->photo = $request->file('photo')->store('produits');
        $photo->save();
        return redirect()->back()->with('info','image modifie avec success');
    }
}

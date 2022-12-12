<?php

namespace App\Http\Controllers\Admin;

use App\Action\DecryptBase64File;
use App\Http\Controllers\Controller;
use App\Models\CategorieProduit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategorieProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categorieProduits = CategorieProduit::query()->orderBy("created_at","desc")->get();
        return view("admin.categorie_produits.index", compact('categorieProduits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view("admin.categorie_produits.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // je valide mes entrees
        $request->validate([
            'nom'=>"required|string",
            'description'=>'required|string',
            'imageHidden'=>"required|required"
        ],[
            "imageHidden"=>"vous devez vous assurez que l'image a bien ete couper"
        ]);
        // je traite l'image coupe
        $stream = DecryptBase64File::decrypt($request->input("imageHidden"));
        $filename = "categorie_produits/". $stream->name;
        
        //je sotcke mon objet en base de donnees 
        CategorieProduit::query()->create([
            "nom"=>$request->input("nom"),
            "description"=>$request->input("description"),
            "image"=>$filename
        ]);
        // je sotcke mon image dans le repertoire
        Storage::put($filename,$stream->content);
        // je redirige l'admin vers la page d'index des categories
        return redirect()->route("admin.categorieProduit.index")->with("success", "votre categorie a bien ete creer");

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
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        // je selectionne la categorie de produit
        $categorieProduit = CategorieProduit::query()->findOrFail($id);
        return view('admin.categorie_produits.edit', compact('categorieProduit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // ja valide mes donnes qui viennents du formulaires

        $request->validate([
            'nom'=>"required|string",
            "description"=>"required|string|min:8",
            "imageHidden"=>"required|string"
        ],[
            "imageHidden"=>"le champ image doit etre bien cropper"
        ]);
        // je verifie si le nom de ce produit n'est pas deja utiliser par un autre
        $nameExists = CategorieProduit::query()->select("nom")->whereKeyNot($id)->where("nom","=",$request->nom)->exists();
        if ($nameExists)
            return redirect()->back()->withErrors("ce nom est deja utilise par un autre produit");
        
        // je decrype mon image cropper
        $stream = DecryptBase64File::decrypt($request->input("imageHidden"));
        $filename = "categorie_produits/" . $stream->name;
        // je met a jour ma categorie de produit
        $item = CategorieProduit::query()->find($id);
        if($item->nom != $request->nom){
            $item->nom = $request->nom;
        }
        // je supprime l'amcien fichier
        if($item->image)
            Storage::delete($item->image);
        $item->description = $request->input("description");
        $item->image = $filename;
        $item->updated_at = now();
        $item->save();
        // j'enregistre l'image dans son repertoire
        Storage::put($filename,$stream->content);

        return redirect()->route("admin.categorieProduit.index")->with("success", "la categorie {$request->nom} a ete modifier avec success !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //1) je recupere le produit , 
        $categorieProduit = CategorieProduit::query()->find($id);
        //2) je supprime son image si elle existe 
        if ($categorieProduit->image)
            Storage::delete($categorieProduit->image);
        //je supprime la categorie en question ( le probleme c'est que ils y'a certains images qui dependent de cette categories)
        $categorieProduit->delete(); 
        //3) je redirige l'admin vers la page index
        return redirect()->back()->with("info", "la categorie a ete supprime avec success");
    }
}

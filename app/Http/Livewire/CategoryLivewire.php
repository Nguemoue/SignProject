<?php

namespace App\Http\Livewire;

use App\Models\Produit;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MarqueProduit;
use App\Models\CouleurProduit;
use App\Models\CategorieProduit;

class CategoryLivewire extends Component
{
    use WithPagination;
    public function updatingCategorie()
    {
        $this->resetPage();
    }
    public $categorie = '';
    
    function setCategorie($cat){
        $this->resetPage();
        $this->categorie = $cat;
    }
    public function render()
    {
        $perPage = 10;
        $categorieFilter = $this->categorie;
        $currentCat = $categorieFilter;
        $nbProduits = Produit::query()->count();
        $categorieFilter = CategorieProduit::query()->where("nom", "=", $categorieFilter)->pluck('id')->first();

        $produits = Produit::query()->with('categorie')->when($categorieFilter, function ($query) use ($categorieFilter, $perPage) {
            $query->where("categorie_produit_id", $categorieFilter)->with('categorie')->paginate($perPage);
        })->paginate($perPage);

        $categories = CategorieProduit::query()->withExists(["produits"])->withCount("produits")->get();

        $marques = MarqueProduit::query()->with("produits")->get();
        $couleurs = CouleurProduit::query()->with("produits")->get();
        return view('livewire.category-livewire',[
            'produits'=>$produits,
            'categories'=>$categories,
            'currentCat'=>$currentCat,
            'nbProduits'=>$nbProduits
        ]);
    }
    public function updated($field , $newVal){
        if($field == "categorie"){
            dd($newVal);
        }
    }
}

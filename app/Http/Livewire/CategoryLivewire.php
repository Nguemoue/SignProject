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

    public $search = '';
    public $colors = [];
    public $tempColor = '';
    public $nbProduits = 0;
    public function updatingCategorie()
    {
        $this->resetPage();
    }
    public $categories = [];
    public $categorie = '';
    
    function setCategorie($cat){
        $this->reset('search');
        $this->resetPage();
        $this->categorie = $cat;
    }

    function setColor($color){
        $this->tempColor = $color;
        dd('de');
    }
    public function render()
    {
        $perPage = 10;
        $categorie = $this->categorie;
        $couleur = $this->tempColor;
        $search = $this->search;
        $produits = Produit::query()->with('categorie')->when($categorie, function ($query) use ($categorie, $perPage) {
        
            $query->join("categorie_produits","produits.categorie_produit_id","=","categorie_produits.id")->where("categorie_produits.nom","like",$categorie)
                ->select("produits.*")->paginate($perPage);
        
        })->when($couleur,function($query) use($couleur,$perPage){
            $query->join("couleur_produits", "produits.id", "=", "couleur_produits.produit_id")->where("couleur_produits.nom", "like", $couleur)
            ->select("produits.*")->paginate($perPage);
        })->when($search,function($query) use ($search,$perPage){
            $query->select("produits.*")->where("produits.nom","like",'%'.$search.'%')->paginate($perPage);
        })->paginate($perPage);
        

          return view('livewire.category-livewire',[
            'produits'=>$produits,
        ]);
    }
    public function updated($field , $newVal){
        //code pour la mise a jour

    }

    public function rechercher(){
        // operation lors de la recherche

    }
    public function mount(){
        $this->nbProduits = Produit::query()->count();
        $this->colors = CouleurProduit::query()->withExists('produit')->pluck('nom');
        $this->categories = CategorieProduit::query()->join('produits','produits.categorie_produit_id','=','categorie_produits.id')->selectRaw('distinct categorie_produits.*')->get();
        
    }
}

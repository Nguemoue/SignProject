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
    const PER_PAGE = 10;
    public $search = '';
    public $colors = [];
    public $nbProduits = 0;
    public function updatingCategorie()
    {
        $this->resetPage('page');
    }
    public $categories = [];
    public $categorie = '';
    
    function setCategorie($cat){
        $this->resetPage();
        $this->categorie = $cat;
    }


    public function render()
    {
        $search = $this->search;
        $produits = Produit::query()->with('categorie')
            ->when($this->categorie, function ($query) {
                return $query->join("categorie_produits", "produits.categorie_produit_id", "=", "categorie_produits.id")->where("categorie_produits.nom", "like", $this->categorie)
                    ->select("produits.*");
        })->when($this->search,function($query){
            return $query->select("produits.*")->where("produits.nom","like",'%'.$this->search.'%');
        })->paginate(self::PER_PAGE);
        

          return view('livewire.category-livewire',[
            'produits'=>$produits,
        ]);
    }
    
    public function rechercher(){
        // operation lors de la recherche

    }
    public function mount(){
        $this->nbProduits = Produit::query()->count();
        $this->categories = CategorieProduit::query()->join('produits','produits.categorie_produit_id','=','categorie_produits.id')->selectRaw('distinct categorie_produits.*')->get();
        
    }
}

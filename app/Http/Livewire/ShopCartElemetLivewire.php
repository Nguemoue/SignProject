<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShopCartElemetLivewire extends Component
{
    public $produit;
    public $quant = 0;
    public function render()
    {
        return view('livewire.shop-cart-elemet-livewire');
    }

    
    
    function mount(){
        // $this->quantite = $this->produit->nombre;
        $this->produit->total = $this->produit->nombre * $this->produit->prix;   
    }
}

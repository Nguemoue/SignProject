<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CartElementComponent extends Component
{
    // declare the properties of the application
    public $produit = null;
    public $quantite = 0;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($produit)
    {   
        $this->produit = $produit;
        $this->quantite = $produit->nombre; 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->produit->total = $this->produit->prix * $this->quantite;
        return view('components.cart-element-component');
    }
}

<?php

namespace App\Http\Controllers\Shop;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\MarqueProduit;
use App\Models\CouleurProduit;
use App\Models\CategorieProduit;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function __invoke(Request $request)
    {
        
        
        return view("shop.category");
    }
}

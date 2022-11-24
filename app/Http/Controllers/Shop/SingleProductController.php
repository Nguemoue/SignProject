<?php

namespace App\Http\Controllers\Shop;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SingleProductController extends Controller
{
   function __invoke(Request $request,Produit $productId){

        return view("shop.singleProduct",[
            'produit'=>$productId
        ]);
    }
}

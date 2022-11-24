<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCheckoutController extends Controller
{
    function __invoke(Request $request)
    {
        return view("shop.checkout");
    }
}

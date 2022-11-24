<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    function __invoke(Request $request)
    {
        return view("contact");
    }
}

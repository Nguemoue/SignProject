<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\commande;
use App\Models\User;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    function index(){
        $commandes = commande::query()->where("isValidated","=",0)->get();

        return view("admin.commandes.index", compact("commandes"));
    }

    function details(User $user,Commande $commande){
        return view("admin.commandes.details", compact('user', 'commande'));
    }
}

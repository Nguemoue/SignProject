<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home(){
        return view('home');
    }

    function acceuil(){
        return view('acceuil');
    }
    function dashboard(){
        return view("dashboard");
    }
}

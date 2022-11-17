<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home(){
        return view('welcome');
    }

    function acceuil(){
        return view('acceuil');
    }
    function dashboard(){
        return view("dashboard");
    }
}

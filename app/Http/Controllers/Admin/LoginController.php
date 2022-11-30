<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function __construct()
    {
        $this->middleware("guest:admin")->except("index");
    }

    function index(){
        return view("admin.login");
    }



}

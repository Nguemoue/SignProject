<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterAdminController extends Controller
{
    function __construct()
    {
        
    }
    function __invoke(Request $request)
    {
        dd($request);
    }
}

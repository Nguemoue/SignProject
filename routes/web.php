<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    "middleware" => ["auth","verified"]
],function (){
    Route::get("/dashboard",[\App\Http\Controllers\HomeController::class,"dashboard"])->name("dashboard");
    Route::get("/",[\App\Http\Controllers\HomeController::class,"home"])->name("home");
    Route::get("/category",[ShopController::class,"category"])->name("shop.category");
});



require __DIR__.'/auth.php';

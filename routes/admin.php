<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProduitController as AdminProduitController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\CouleurProduitController;
use App\Http\Controllers\Admin\PhotoProduitController;
use App\Http\Controllers\Admin\SpecificationController;
use App\Models\PhotoProduit;
use App\Models\Produit;

Route::middleware('guest:admin')->group(function () {
    Route::get("/admin/login", [AdminAuthenticatedSessionController::class, "create"])
    ->name("admin.login");
    Route::post("/admin/register", [AdminAuthenticatedSessionController::class, "store"])
    ->name("admin.register");
});

Route::group(
    [
        'prefix' => '/admin',
        'as' => 'admin.',
        'middleware' => ['auth:admin']
    ],
    function () {
        Route::get('/', [AdminHomeController::class, "index"])->name("home")->withoutMiddleware("auth:admin");;
        Route::post("/profile/update", [AdminHomeController::class, "updateProfile"])->name("profile.update");
        Route::post("/password/update", [AdminHomeController::class, "updatepassword"])->name("password.update");
        Route::resource('users', AdminUserController::class);
        Route::resource('produits', AdminProduitController::class);
        Route::resource('photoProduit',PhotoProduitController::class)->except(["edit","create","index"]);
        Route::resource('couleurProduit',CouleurProduitController::class)->except('create','edit','show','index');
        Route::post("photoProduit/changePhoto",[PhotoProduitController::class,"changePhoto"])->name("photoProduit.changePhoto");
        Route::resource('blogs', AdminBlogController::class);
        Route::post("/produit/{produit}/specification",[SpecificationController::class,"update"])->name('produit.specification.update');
    }
);

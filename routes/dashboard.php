<?php
// <!-- fichier de routing pour la partie dashboard -->

use App\Http\Controllers\Dashboard\DashboardCommandeController;
use App\Http\Controllers\DashboardAccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get("/dashboard", [DashboardController::class, "index"])->middleware(["auth","verified"])->name("dashboard");
Route::group(
    [
        "middleware" => ["auth", "verified"],
        "as" => "dashboard.",
        "prefix" => "dashboard"
    ],
    function () {
        Route::get("/commandes", [DashboardCommandeController::class, "index"])->name("commandes.index");
        Route::get("/commandes/{id}/detail", [DashboardCommandeController::class, "detail"])->name("commandes.detail");

        Route::get("/account/profile", [DashboardAccountController::class, "profile"])->name("account.profile");
        Route::get("/notifications", [DashboardAccountController::class, "notifications"])->name("account.notifications");
        
        // Route pour la photo de profile
        Route::post("/user/photo/update", [DashboardAccountController::class, "updatePhoto"])->name("photo.update");
        Route::post("/user/password/update", [DashboardAccountController::class, "updatePassword"])->name("password.update");
        Route::post("/user/profile/update", [DashboardAccountController::class, "updateProfile"])->name("profile.update");
        Route::post("/user/adresse/update", [DashboardAccountController::class, "updateAdresse"])->name("adresse.update");
    }
);
// home route



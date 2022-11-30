<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Blog\SingleBlogController;
use App\Http\Controllers\Shop\ConfirmationController;
use App\Http\Controllers\Shop\SingleProductController;
use App\Http\Controllers\Shop\ProductCheckoutController;

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

Route::get("/", [\App\Http\Controllers\HomeController::class, "home"])->name("home");

//not use middleware
Route::prefix("shop")->group(function () {
    Route::get("/category", [CategoryController::class, "__invoke"])->name("shop.category");
    Route::get("/single-product/{productId}", [SingleProductController::class, "__invoke"])->name("shop.singleProduct")->whereNumber("productId");
});

Route::group([
    "middleware" => ["auth", "verified"]
], function () {

    // home route
    Route::get("/dashboard", [\App\Http\Controllers\HomeController::class, "dashboard"])->name("dashboard");

    //shop routes
    Route::prefix("shop")->group(function () {
        Route::get("/checkout", [ProductCheckoutController::class, "__invoke"])->name("shop.checkout");
        Route::post("/checkout",[ProductCheckoutController::class,"checkout"])->name("shop.checkout.store");
        Route::get("/confirmation", [ConfirmationController::class, "__invoke"])->name("shop.confirmation");
        Route::post('/confirmation',[ConfirmationController::class,"store"])->name('shop.confirmation.store');
        Route::get("/cart", [CartController::class, "__invoke"])->name("shop.cart");
    });

    //blog routes
    Route::prefix("blog")->group(function () {
        Route::get("/", [BlogController::class, "__invoke"])->name("blog.index");
        Route::get("/single-blog/{blogId}", [SingleBlogController::class, "__invoke"])->name("blog.singleBlog");
    });

    //route pour la cart
    Route::post('cart', [CartController::class, "index"])->name("cart.index");
    Route::get('cart/destroy', [CartController::class, "delete"])->name("cart.delete");
});

//routes for contact
Route::get("/contact", [ContactController::class, "__invoke"])->name("contact");
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

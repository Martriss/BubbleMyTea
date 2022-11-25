<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('default');
});

Route::get('/contact', function () {
    return view('contact');
});


Route::get('/accueil', function () {
    return view('accueil');
})->name('about');

Route::get('/catalogue', [RecipeController::class, 'index'])->name('catalogue');
Route::get('/best_seller', [RecipeController::class, 'best_seller'])->name('best_seller');
Route::get('recipe/restore/{recipe}', [RecipeController::class, 'restore'])->name('recipe.restore');

Route::resource('recipe', RecipeController::class);


Route::get('/user/history', [OrderController::class, 'index'])->name('history');

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('dashboard');

Route::get('password', [PasswordController::class, 'index'])->name('password');    //pour changer le password dans le profil
Route::post('password', [PasswordController::class, 'store'])->name('switch.password');

Route::get('profile', [ProfilController::class, 'index'])->name('profile');    
Route::post('profile', [ProfilController::class, 'profileUpdate'])->name('profile.update'); //pour edité le profil

Route::resource('order', OrderController::class);
Route::resource('product', ProductController::class);
Route::resource('shopping_cart', ShoppingCartController::class);
Route::resource('profil', ProfilController::class);

require __DIR__.'/auth.php';

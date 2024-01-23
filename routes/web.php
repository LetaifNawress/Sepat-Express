<?php

use App\Http\Controllers\VendeurController;

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
    return view('welcome');
});

// Routes pour le VendeurController
Route::post('/vendeur/categorie', [VendeurController::class, 'createCategory']);
Route::post('/vendeur/produit', [VendeurController::class, 'createProduct']);
Route::get('/vendeur/categories', [VendeurController::class, 'showCategories']);
Route::get('/vendeur/produits', [VendeurController::class, 'showProducts']);

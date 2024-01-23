<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendeurController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['api'])->group(function () {
    // Vos routes API ici

    // Exclure le middleware auth:sanctum pour ces routes
    Route::post('/vendeur/categorie', [VendeurController::class, 'createCategory']);
    Route::post('/vendeur/produit', [VendeurController::class, 'createProduct']);
    Route::get('/vendeur/categories', [VendeurController::class, 'showCategories']);
    Route::get('/vendeur/produits', [VendeurController::class, 'showProducts']);
});

// Routes nécessitant une authentification
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

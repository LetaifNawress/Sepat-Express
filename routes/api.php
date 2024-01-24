<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendeurController;
use App\Http\Controllers\AdminController;

Route::middleware(['api'])->group(function () {
    // Vos routes API ici

    // Exclure le middleware auth:sanctum pour ces routes
    Route::post('/vendeur/categorie', [VendeurController::class, 'createCategory']);
    Route::post('/vendeur/produit', [VendeurController::class, 'createProduct']);
    Route::get('/vendeur/categories', [VendeurController::class, 'showCategories']);
    Route::get('/vendeur/produits', [VendeurController::class, 'showProducts']);

    // Roles routes
    Route::get('/admin/roles', [AdminController::class, 'getRoles'])->name('admin.roles.index');
    Route::post('/admin/roles', [AdminController::class, 'storeRole'])->name('admin.roles.store');
    Route::put('/admin/roles/{role}', [AdminController::class, 'updateRole'])->name('admin.roles.update');
    Route::delete('/admin/roles/{role}', [AdminController::class, 'destroyRole'])->name('admin.roles.destroy');
    Route::get('/admin/roles/{role}/edit', [AdminController::class, 'editRole'])->name('admin.roles.edit');
    Route::put('/admin/roles/{role}', [AdminController::class, 'updateRole'])->name('admin.roles.update');

    // Users routes
Route::get('/admin/users', [AdminController::class, 'getUsers'])->name('admin.users.index');
Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
Route::post('/admin/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Placeholder comment: Define the addTester method in your AdminController
    Route::post('/admin/users/add-tester', [AdminController::class, 'addTester'])->name('admin.users.addTester');
});

// Routes nécessitant une authentification
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

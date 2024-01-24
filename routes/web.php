<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/order', function () {
    return view('client.orderConfirmation');
});


Route::get('/checkout', function () {
    return view('client.productCheckout');
});


Route::get('/category', function () {
    return view('client.shopcategory');
});


Route::get('/cart', function () {
    return view('client.shoppingCart');
});


Route::get('/shop-single', function () {
    return view('client.shopSingle');
});

// Roles routes
Route::get('/admin/roles', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/roles/create', [AdminController::class, 'createRole'])->name('admin.roles.create');
Route::post('/admin/roles/store', [AdminController::class, 'storeRole'])->name('admin.roles.store');
Route::get('/admin/roles/{role}/edit', [AdminController::class, 'editRole'])->name('admin.roles.edit');
Route::put('/admin/roles/{role}', [AdminController::class, 'updateRole'])->name('admin.roles.update');
Route::delete('/admin/roles/{role}', [AdminController::class, 'destroyRole'])->name('admin.roles.destroy');


// Users routes
Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
Route::post('/admin/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
Route::post('/admin/users/add-tester', [AdminController::class, 'addTester'])->name('admin.users.addTester');




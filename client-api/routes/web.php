<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('auth.index'); // Redirige al login
});

// Dashboard o página principal después de login
Route::get('/index', function () {
    return view('index');
})->name('index');

// Grupo de autenticación
Route::prefix('auth')->name('auth.')->group(function(){
    Route::get('/index', [AuthController::class,'index'])->name('index'); // vista de login
    Route::post('/login', [AuthController::class,'login'])->name('login');
    Route::get('/register', [AuthController::class,'create'])->name('register');
    Route::post('/register', [AuthController::class,'store'])->name('store');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});



// Rutas de producto
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});








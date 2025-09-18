<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('auth.index'); // Redirige al login
});

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::prefix('auth')->group(function(){
    Route::get('/index', [AuthController::class,'index'])->name('auth.index'); // tu login
    Route::post('/login', [AuthController::class,'login'])->name('auth.login');
    Route::get('/register', [AuthController::class,'create'])->name('auth.register');
    Route::post('/register', [AuthController::class,'store'])->name('auth.store');
});

Route::prefix('auth')->group(function(){
    Route::get('/logout', [AuthController::class,'logout'])->name('auth.logout');
});



// Rutas de producto
Route::prefix('product')->group(function () {
    Route::get('/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});





<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

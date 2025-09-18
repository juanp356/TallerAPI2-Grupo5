<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    // Solo para probar, luego aquí irá tu lógica de login
    return 'Formulario enviado con email: ' . $request->email;
})->name('auth.login');


// Vista de registro
Route::get('/register', function () {
    return view('auth.register');
})->name('auth.register');

// Acción de registro (POST)
Route::post('/register', function (Request $request) {
    return 'Registro enviado con email: ' . $request->email;
})->name('auth.register.submit');







<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. This group includes
| session state, CSRF protection, etc.
|
*/

// Ruta raíz por defecto de Laravel (opcional)
Route::get('/', function () {
    return view('welcome');
});

// Si en el futuro agregas una interfaz web (Blade, Inertia, etc.)
// Define esas rutas aquí.
// Pero tus rutas RESTful para datos deben estar en routes/api.php

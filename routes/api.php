<?php

use Illuminate\Support\Facades\Route;
// Importamos todos los controladores API
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UbicacionController;
use App\Http\Controllers\API\EventoController;
use App\Http\Controllers\API\ArtistaController;
use App\Http\Controllers\API\TipoDeBoletoController;
use App\Http\Controllers\API\PaqueteBoletoController;
use App\Http\Controllers\API\EventoArtistaController;
use App\Http\Controllers\API\DescuentoController;
use App\Http\Controllers\API\CompraController;
use App\Http\Controllers\API\BoletoController;
use App\Http\Controllers\API\CompraDescuentoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. This middleware group
| does NOT include session state or CSRF protection, which is ideal
| for building stateless RESTful APIs.
|
| The "api" prefix is automatically applied to routes in this file.
|
*/

// --- RUTAS DE LA API ---
// Laravel automatically applies the 'api' middleware group to routes here.
// This group (defined in App\Http\Kernel) is stateless and perfect for APIs.

// Rutas para Usuarios
Route::apiResource('users', UserController::class);

// Rutas para Ubicaciones
Route::apiResource('ubicaciones', UbicacionController::class);

// Rutas para Eventos
Route::apiResource('eventos', EventoController::class);

// Rutas para Artistas
Route::apiResource('artistas', ArtistaController::class);

// Rutas para Tipos de Boletos
Route::apiResource('tipos-de-boletos', TipoDeBoletoController::class);

// Rutas para Paquetes de Boletos
Route::apiResource('paquetes-boletos', PaqueteBoletoController::class);

// Rutas para la relación Evento-Artista (Pivote)
// Nota: Para relaciones pivote, generalmente no se usa 'update'
Route::apiResource('eventos-artistas', EventoArtistaController::class)->except(['update']);

// Rutas para Descuentos
Route::apiResource('descuentos', DescuentoController::class);

// Rutas para Compras
Route::apiResource('compras', CompraController::class);

// Rutas para Boletos
Route::apiResource('boletos', BoletoController::class);

// Rutas para la relación Compra-Descuento (Pivote)

Route::apiResource('compra-descuentos', CompraDescuentoController::class)->except(['update']);


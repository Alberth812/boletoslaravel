<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Agrupamos todas las rutas bajo el prefijo 'api' y el middleware 'api'
// (El prefijo 'api' ya se aplica por defecto al cargar este archivo)

Route::middleware('api')->group(function () {
    // Rutas para Usuarios
    Route::apiResource('users', API\UserController::class);

    // Rutas para Ubicaciones
    Route::apiResource('ubicaciones', API\UbicacionController::class);

    // Rutas para Eventos
    Route::apiResource('eventos', API\EventoController::class);

    // Rutas para Artistas
    Route::apiResource('artistas', API\ArtistaController::class);

    // Rutas para Tipos de Boletos
    Route::apiResource('tipos-de-boletos', API\TipoDeBoletoController::class);

    // Rutas para Paquetes de Boletos
    Route::apiResource('paquetes-boletos', API\PaqueteBoletoController::class);

    // Rutas para la relación Evento-Artista (Pivote)
    Route::apiResource('eventos-artistas', API\EventoArtistaController::class);

    // Rutas para Descuentos
    Route::apiResource('descuentos', API\DescuentoController::class);

    // Rutas para Compras
    Route::apiResource('compras', API\CompraController::class);

    // Rutas para Boletos
    Route::apiResource('boletos', API\BoletoController::class);

    // Rutas para la relación Compra-Descuento (Pivote)
    Route::apiResource('compra-descuentos', API\CompraDescuentoController::class);
});

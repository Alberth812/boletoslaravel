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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. But this is just for
| testing our API controllers quickly, following the guide.
|
*/

// --- RUTAS DE LA API ---
// Agrupamos todas las rutas bajo el prefijo 'api' y el middleware 'api'
Route::middleware(['api'])->prefix('api')->group(function () {
    // Rutas para Usuarios
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Rutas para Ubicaciones
    Route::get('/ubicaciones', [UbicacionController::class, 'index']);
    Route::post('/ubicaciones', [UbicacionController::class, 'store']);
    Route::get('/ubicaciones/{id}', [UbicacionController::class, 'show']);
    Route::put('/ubicaciones/{id}', [UbicacionController::class, 'update']);
    Route::delete('/ubicaciones/{id}', [UbicacionController::class, 'destroy']);

    // Rutas para Eventos
    Route::get('/eventos', [EventoController::class, 'index']);
    Route::post('/eventos', [EventoController::class, 'store']);
    Route::get('/eventos/{id}', [EventoController::class, 'show']);
    Route::put('/eventos/{id}', [EventoController::class, 'update']);
    Route::delete('/eventos/{id}', [EventoController::class, 'destroy']);

    // Rutas para Artistas
    Route::get('/artistas', [ArtistaController::class, 'index']);
    Route::post('/artistas', [ArtistaController::class, 'store']);
    Route::get('/artistas/{id}', [ArtistaController::class, 'show']);
    Route::put('/artistas/{id}', [ArtistaController::class, 'update']);
    Route::delete('/artistas/{id}', [ArtistaController::class, 'destroy']);

    // Rutas para Tipos de Boletos
    Route::get('/tipos-de-boletos', [TipoDeBoletoController::class, 'index']);
    Route::post('/tipos-de-boletos', [TipoDeBoletoController::class, 'store']);
    Route::get('/tipos-de-boletos/{id}', [TipoDeBoletoController::class, 'show']);
    Route::put('/tipos-de-boletos/{id}', [TipoDeBoletoController::class, 'update']);
    Route::delete('/tipos-de-boletos/{id}', [TipoDeBoletoController::class, 'destroy']);

    // Rutas para Paquetes de Boletos
    Route::get('/paquetes-boletos', [PaqueteBoletoController::class, 'index']);
    Route::post('/paquetes-boletos', [PaqueteBoletoController::class, 'store']);
    Route::get('/paquetes-boletos/{id}', [PaqueteBoletoController::class, 'show']);
    Route::put('/paquetes-boletos/{id}', [PaqueteBoletoController::class, 'update']);
    Route::delete('/paquetes-boletos/{id}', [PaqueteBoletoController::class, 'destroy']);

    // Rutas para la relación Evento-Artista (Pivote)
    Route::get('/eventos-artistas', [EventoArtistaController::class, 'index']);
    Route::post('/eventos-artistas', [EventoArtistaController::class, 'store']);
    Route::get('/eventos-artistas/{id}', [EventoArtistaController::class, 'show']);
    Route::delete('/eventos-artistas/{id}', [EventoArtistaController::class, 'destroy']);
    // Nota: Para pivotes, generalmente no se usa PUT, se elimina y se crea de nuevo.

    // Rutas para Descuentos
    Route::get('/descuentos', [DescuentoController::class, 'index']);
    Route::post('/descuentos', [DescuentoController::class, 'store']);
    Route::get('/descuentos/{id}', [DescuentoController::class, 'show']);
    Route::put('/descuentos/{id}', [DescuentoController::class, 'update']);
    Route::delete('/descuentos/{id}', [DescuentoController::class, 'destroy']);

    // Rutas para Compras
    Route::get('/compras', [CompraController::class, 'index']);
    Route::post('/compras', [CompraController::class, 'store']);
    Route::get('/compras/{id}', [CompraController::class, 'show']);
    Route::put('/compras/{id}', [CompraController::class, 'update']);
    Route::delete('/compras/{id}', [CompraController::class, 'destroy']);

    // Rutas para Boletos
    Route::get('/boletos', [BoletoController::class, 'index']);
    Route::post('/boletos', [BoletoController::class, 'store']);
    Route::get('/boletos/{id}', [BoletoController::class, 'show']);
    Route::put('/boletos/{id}', [BoletoController::class, 'update']);
    Route::delete('/boletos/{id}', [BoletoController::class, 'destroy']);

    // Rutas para la relación Compra-Descuento (Pivote)
    Route::get('/compra-descuentos', [CompraDescuentoController::class, 'index']);
    Route::post('/compra-descuentos', [CompraDescuentoController::class, 'store']);
    Route::get('/compra-descuentos/{id}', [CompraDescuentoController::class, 'show']);
    Route::delete('/compra-descuentos/{id}', [CompraDescuentoController::class, 'destroy']);
    // Nota: Para pivotes, generalmente no se usa PUT, se elimina y se crea de nuevo.
});

// Ruta raíz por defecto de Laravel (opcional, puedes dejarla o eliminarla)
Route::get('/', function () {
    return view('welcome');
});

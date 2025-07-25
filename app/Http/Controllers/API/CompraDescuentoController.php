<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CompraDescuento;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class CompraDescuentoController extends Controller
{
    public function index(): JsonResponse
    {
        $compraDescuentos = CompraDescuento::with(['compra', 'descuento'])->get();
        return response()->json($compraDescuentos);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'compra_id' => 'required|exists:compras,id',
            'descuento_id' => 'required|exists:descuentos,id',
            'monto_aplicado' => 'required|numeric|min:0',
             // Validación de unicidad de la combinación
        ], [
            'compra_id.unique' => 'Este descuento ya ha sido aplicado a esta compra.',
        ]);

         // Validación adicional para unicidad de la combinación
        $request->validate([
           'compra_id' => Rule::unique('compra_descuentos')->where(function ($query) use ($request) {
                return $query->where('descuento_id', $request->descuento_id);
            }),
        ], [
            'compra_id.unique' => 'Este descuento ya ha sido aplicado a esta compra.'
        ]);


        $compraDescuento = CompraDescuento::create($validatedData);

        // Cargar relaciones para la respuesta
        $compraDescuento->load(['compra', 'descuento']);

        return response()->json($compraDescuento, 201);
    }

    public function show(string $id): JsonResponse
    {
        $compraDescuento = CompraDescuento::with(['compra.usuario', 'descuento'])->findOrFail($id);
        return response()->json($compraDescuento);
    }

    // Generalmente no se actualiza una relación pivote, se elimina y se crea de nuevo
    // public function update(Request $request, string $id) { ... }

    public function destroy(string $id): JsonResponse
    {
        CompraDescuento::destroy($id);
        return response()->json(null, 204);
    }
}

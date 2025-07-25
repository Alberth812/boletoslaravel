<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CompraController extends Controller
{
    public function index(): JsonResponse
    {
        // Cargar relaciones importantes
        $compras = Compra::with(['usuario', 'evento', 'boletos', 'descuentos'])->get();
        return response()->json($compras);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'evento_id' => 'required|exists:eventos,id',
            'fecha_compra' => 'required|date',
            // 'total' normalmente se calcularía, pero permitimos establecerlo
            'total' => 'required|numeric|min:0',
            'metodo_pago' => 'required|in:Tarjeta,PayPal,Transferencia,Bizum,Otro',
            'estado' => 'required|in:Completada,Pendiente,Cancelada,Reembolsada',
            'numero_confirmacion' => 'required|string|unique:compras,numero_confirmacion',
        ]);

        $compra = Compra::create($validatedData);

        // Cargar relaciones para la respuesta
        $compra->load(['usuario', 'evento']);

        return response()->json($compra, 201);
    }

    public function show(string $id): JsonResponse
    {
        $compra = Compra::with(['usuario', 'evento', 'boletos.tipoBoleto', 'descuentos'])->findOrFail($id);
        return response()->json($compra);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $compra = Compra::findOrFail($id);

        $validatedData = $request->validate([
            'usuario_id' => 'sometimes|exists:users,id',
            'evento_id' => 'sometimes|exists:eventos,id',
            'fecha_compra' => 'sometimes|date',
            'total' => 'sometimes|numeric|min:0',
            'metodo_pago' => 'sometimes|in:Tarjeta,PayPal,Transferencia,Bizum,Otro',
            'estado' => 'sometimes|in:Completada,Pendiente,Cancelada,Reembolsada',
            'numero_confirmacion' => [
                'sometimes',
                'string',
                Rule::unique('compras')->ignore($compra->id),
            ],
        ]);

        $compra->update($validatedData);

        return response()->json($compra);
    }

    public function destroy(string $id): JsonResponse
    {
        Compra::destroy($id);
        return response()->json(null, 204);
    }
}
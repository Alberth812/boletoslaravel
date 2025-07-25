<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Descuento;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class DescuentoController extends Controller
{
    public function index(): JsonResponse
    {
        $descuentos = Descuento::all();
        return response()->json($descuentos);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|unique:descuentos,codigo|max:50',
            'descripcion' => 'required|string|max:255',
            'porcentaje' => 'nullable|numeric|min:0|max:100',
            'monto_fijo' => 'nullable|numeric|min:0',
            'fecha_inicio' => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'usos_maximos' => 'nullable|integer|min:1',
            'activo' => 'boolean',
        ], [
            // Validación personalizada: Debe tener porcentaje O monto_fijo, pero no ambos
            // Esto se maneja mejor en una regla de validación personalizada o en el controlador
        ]);

        // Validación adicional: Exclusividad entre porcentaje y monto_fijo
        if (isset($validatedData['porcentaje']) && isset($validatedData['monto_fijo'])) {
             return response()->json([
                'message' => 'La validación falló.',
                'errors' => [
                    'general' => 'Un descuento debe tener un porcentaje O un monto fijo, no ambos.'
                ]
            ], 422); // 422 Unprocessable Entity
        }
        if (!isset($validatedData['porcentaje']) && !isset($validatedData['monto_fijo'])) {
             return response()->json([
                'message' => 'La validación falló.',
                'errors' => [
                    'general' => 'Un descuento debe tener un porcentaje o un monto fijo.'
                ]
            ], 422);
        }

        $descuento = Descuento::create($validatedData);

        return response()->json($descuento, 201);
    }

    public function show(string $id): JsonResponse
    {
        $descuento = Descuento::with('compras')->findOrFail($id);
        return response()->json($descuento);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $descuento = Descuento::findOrFail($id);

        $validatedData = $request->validate([
            'codigo' => [
                'sometimes',
                'string',
                'max:50',
                Rule::unique('descuentos')->ignore($descuento->id),
            ],
            'descripcion' => 'sometimes|string|max:255',
            'porcentaje' => 'nullable|numeric|min:0|max:100',
            'monto_fijo' => 'nullable|numeric|min:0',
            'fecha_inicio' => 'sometimes|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'sometimes|date|after_or_equal:fecha_inicio',
            'usos_maximos' => 'nullable|integer|min:1',
            'activo' => 'boolean',
        ]);

         // Validación adicional en update también
        if ((isset($validatedData['porcentaje']) && isset($validatedData['monto_fijo'])) ||
            (!isset($validatedData['porcentaje']) && !isset($validatedData['monto_fijo']) && !$request->isMethod('PATCH'))) {
            // Solo validar si se envían ambos en un PUT, o ninguno en un PUT
            // En PATCH, si no se envían, se asume que se mantienen los actuales
            if($request->isMethod('PUT')) {
                 return response()->json([
                    'message' => 'La validación falló.',
                    'errors' => [
                        'general' => 'Un descuento debe tener un porcentaje O un monto fijo, no ambos.'
                    ]
                ], 422);
            }
        }


        $descuento->update($validatedData);

        return response()->json($descuento);
    }

    public function destroy(string $id): JsonResponse
    {
        Descuento::destroy($id);
        return response()->json(null, 204);
    }
}
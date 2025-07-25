<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class BoletoController extends Controller
{
    public function index(): JsonResponse
    {
        $boletos = Boleto::with(['compra', 'tipoBoleto', 'evento'])->get();
        return response()->json($boletos);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'compra_id' => 'required|exists:compras,id',
            'tipo_boleto_id' => 'required|exists:tipos_de_boletos,id',
            'evento_id' => 'required|exists:eventos,id',
            'numero_serie' => 'required|string|unique:boletos,numero_serie',
            'qr_code' => 'nullable|string|max:255',
            'asiento' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:Activo,Usado,Cancelado,Reservado',
        ]);

        $boleto = Boleto::create($validatedData);

        // Cargar relaciones para la respuesta
        $boleto->load(['compra.usuario', 'tipoBoleto', 'evento']);

        return response()->json($boleto, 201);
    }

    public function show(string $id): JsonResponse
    {
        $boleto = Boleto::with(['compra.usuario', 'tipoBoleto', 'evento'])->findOrFail($id);
        return response()->json($boleto);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $boleto = Boleto::findOrFail($id);

        $validatedData = $request->validate([
            'compra_id' => 'sometimes|exists:compras,id',
            'tipo_boleto_id' => 'sometimes|exists:tipos_de_boletos,id',
            'evento_id' => 'sometimes|exists:eventos,id',
            'numero_serie' => [
                'sometimes',
                'string',
                Rule::unique('boletos')->ignore($boleto->id),
            ],
            'qr_code' => 'nullable|string|max:255',
            'asiento' => 'nullable|string|max:50',
            'precio' => 'sometimes|numeric|min:0',
            'estado' => 'sometimes|in:Activo,Usado,Cancelado,Reservado',
        ]);

        $boleto->update($validatedData);

        return response()->json($boleto);
    }

    public function destroy(string $id): JsonResponse
    {
        Boleto::destroy($id);
        return response()->json(null, 204);
    }
}
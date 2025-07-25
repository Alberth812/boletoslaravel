<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TipoDeBoleto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TipoDeBoletoController extends Controller
{
    public function index(): JsonResponse
    {
        $tipos = TipoDeBoleto::all();
        return response()->json($tipos);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_base' => 'required|numeric|min:0',
            'zona_asiento' => 'nullable|string|max:100',
        ]);

        $tipo = TipoDeBoleto::create($validatedData);

        return response()->json($tipo, 201);
    }

    public function show(string $id): JsonResponse
    {
        $tipo = TipoDeBoleto::with('boletos')->findOrFail($id);
        return response()->json($tipo);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $tipo = TipoDeBoleto::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_base' => 'sometimes|numeric|min:0',
            'zona_asiento' => 'nullable|string|max:100',
        ]);

        $tipo->update($validatedData);

        return response()->json($tipo);
    }

    public function destroy(string $id): JsonResponse
    {
        TipoDeBoleto::destroy($id);
        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PaqueteBoleto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PaqueteBoletoController extends Controller
{
    public function index(): JsonResponse
    {
        $paquetes = PaqueteBoleto::all();
        return response()->json($paquetes);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'cantidad_boletos' => 'required|integer|min:1',
            'activo' => 'boolean',
        ]);

        $paquete = PaqueteBoleto::create($validatedData);

        return response()->json($paquete, 201);
    }

    public function show(string $id): JsonResponse
    {
        $paquete = PaqueteBoleto::findOrFail($id);
        return response()->json($paquete);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $paquete = PaqueteBoleto::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'sometimes|numeric|min:0',
            'cantidad_boletos' => 'sometimes|integer|min:1',
            'activo' => 'boolean',
        ]);

        $paquete->update($validatedData);

        return response()->json($paquete);
    }

    public function destroy(string $id): JsonResponse
    {
        PaqueteBoleto::destroy($id);
        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UbicacionController extends Controller
{
    public function index(): JsonResponse
    {
        $ubicaciones = Ubicacion::all();
        return response()->json($ubicaciones);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'pais' => 'required|string|max:100',
            'capacidad' => 'required|integer|min:1',
        ]);

        $ubicacion = Ubicacion::create($validatedData);

        return response()->json($ubicacion, 201);
    }

    public function show(string $id): JsonResponse
    {
        $ubicacion = Ubicacion::findOrFail($id);
        return response()->json($ubicacion);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $ubicacion = Ubicacion::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'direccion' => 'sometimes|string|max:255',
            'ciudad' => 'sometimes|string|max:100',
            'pais' => 'sometimes|string|max:100',
            'capacidad' => 'sometimes|integer|min:1',
        ]);

        $ubicacion->update($validatedData);

        return response()->json($ubicacion);
    }

    public function destroy(string $id): JsonResponse
    {
        Ubicacion::destroy($id);
        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArtistaController extends Controller
{
    public function index(): JsonResponse
    {
        $artistas = Artista::all();
        return response()->json($artistas);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string|max:255',
            'genero_musical' => 'nullable|string|max:100',
            'pais_origen' => 'nullable|string|max:100',
        ]);

        $artista = Artista::create($validatedData);

        return response()->json($artista, 201);
    }

    public function show(string $id): JsonResponse
    {
        // Cargar eventos donde participa
        $artista = Artista::with('eventos')->findOrFail($id);
        return response()->json($artista);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $artista = Artista::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string|max:255',
            'genero_musical' => 'nullable|string|max:100',
            'pais_origen' => 'nullable|string|max:100',
        ]);

        $artista->update($validatedData);

        return response()->json($artista);
    }

    public function destroy(string $id): JsonResponse
    {
        Artista::destroy($id);
        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventoController extends Controller
{
    public function index(): JsonResponse
    {
        // Cargar relaciones para evitar N+1 queries
        $eventos = Evento::with(['ubicacion', 'artistas'])->get();
        return response()->json($eventos);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'inicio' => 'required|date|after:now',
            'fin' => 'required|date|after:inicio',
            'id_ubicacion' => 'required|exists:ubicaciones,id',
            'lugar' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
            'pais' => 'required|string|max:100',
            'imagen' => 'nullable|string|max:255',
            'estado' => 'required|in:Activo,Cancelado,Finalizado,Próximamente',
        ]);

        $evento = Evento::create($validatedData);

        return response()->json($evento, 201);
    }

    public function show(string $id): JsonResponse
    {
        // Cargar relaciones
        $evento = Evento::with(['ubicacion', 'artistas', 'boletos.tipoBoleto'])->findOrFail($id);
        return response()->json($evento);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $evento = Evento::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'inicio' => 'sometimes|date|after:now',
            'fin' => 'sometimes|date|after:inicio',
            'id_ubicacion' => 'sometimes|exists:ubicaciones,id',
            'lugar' => 'sometimes|string|max:255',
            'ciudad' => 'sometimes|string|max:100',
            'pais' => 'sometimes|string|max:100',
            'imagen' => 'nullable|string|max:255',
            'estado' => 'sometimes|in:Activo,Cancelado,Finalizado,Próximamente',
        ]);

        $evento->update($validatedData);

        return response()->json($evento);
    }

    public function destroy(string $id): JsonResponse
    {
        Evento::destroy($id);
        return response()->json(null, 204);
    }
}
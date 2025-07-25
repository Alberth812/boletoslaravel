<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EventoArtista;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class EventoArtistaController extends Controller
{
    public function index(): JsonResponse
    {
        // Cargar relaciones para más información
        $eventoArtistas = EventoArtista::with(['evento', 'artista'])->get();
        return response()->json($eventoArtistas);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'artista_id' => 'required|exists:artistas,id',
            // Asegurarse de que la combinación evento_id/artista_id sea única
            // 'evento_id' y 'artista_id' deben ser únicos juntos
        ], [
            // Mensajes de error personalizados (opcional)
            'evento_id.unique' => 'Este artista ya está asignado a este evento.',
        ]);

        // Validación adicional para unicidad de la combinación
        $request->validate([
            // Esta regla se aplica después de las primeras validaciones
           'evento_id' => Rule::unique('eventos_artistas')->where(function ($query) use ($request) {
                return $query->where('artista_id', $request->artista_id);
            }),
        ], [
            'evento_id.unique' => 'Este artista ya está asignado a este evento.'
        ]);

        $eventoArtista = EventoArtista::create($validatedData);

        // Cargar relaciones para la respuesta
        $eventoArtista->load(['evento', 'artista']);

        return response()->json($eventoArtista, 201);
    }

    public function show(string $id): JsonResponse
    {
        $eventoArtista = EventoArtista::with(['evento', 'artista'])->findOrFail($id);
        return response()->json($eventoArtista);
    }

    // Generalmente no se usa 'update' en tablas pivote, se elimina y se crea de nuevo
    // public function update(Request $request, string $id) { ... }

    public function destroy(string $id): JsonResponse
    {
        EventoArtista::destroy($id);
        return response()->json(null, 204);
    }
}
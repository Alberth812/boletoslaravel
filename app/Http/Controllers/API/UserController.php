<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule; // Para reglas de validación complejas

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // Puedes paginar: User::paginate(15)
        $users = User::all(); 
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // 1. Validar los datos de entrada
        $validatedData = $request->validate([
            'nombre_usuario' => 'required|string|max:255|unique:users',
            'correo' => 'required|email|unique:users',
            'contraseña_hash' => 'required|string|min:8', // En un sistema real, se haría hash
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date|before:today',
            'es_admin' => 'boolean',
            'esta_activo' => 'boolean',
        ]);

        // 2. Crear el usuario
        // Es importante hacer hash de la contraseña
        $validatedData['contraseña_hash'] = bcrypt($validatedData['contraseña_hash']);
        
        $user = User::create($validatedData);

        // 3. Retornar el recurso creado con código 201
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $user = User::findOrFail($id);

        // 1. Validar los datos de entrada
        $validatedData = $request->validate([
            'nombre_usuario' => [
                'sometimes', // Este campo es opcional en la actualización
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Ignorar el usuario actual para unicidad
            ],
            'correo' => [
                'sometimes',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'contraseña_hash' => 'sometimes|string|min:8', // Si se proporciona, validarla
            'nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'telefono' => 'sometimes|string|max:20',
            'fecha_nacimiento' => 'sometimes|date|before:today',
            'es_admin' => 'boolean',
            'esta_activo' => 'boolean',
        ]);

        // 2. Si se proporciona una nueva contraseña, hacerle hash
        if (isset($validatedData['contraseña_hash'])) {
            $validatedData['contraseña_hash'] = bcrypt($validatedData['contraseña_hash']);
        }

        // 3. Actualizar el usuario
        $user->update($validatedData);

        // 4. Retornar el recurso actualizado
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        // 204 No Content es el código típico para una eliminación exitosa
        return response()->json(null, 204);
    }
}

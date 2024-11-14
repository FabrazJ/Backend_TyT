<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Esta línea es para utilizar el método Hash para cifrar la contraseña

class UserController extends Controller
{
    public function index()
    {
        return User::with(['departamento', 'cargo', 'emails'])->get(); // Obtener todos los usuarios con sus relaciones
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string|max:100',
            'primerNombre' => 'required|string|max:100',
            'primerApellido' => 'required|string|max:100',
            'idDepartamento' => 'required|integer',
            'idCargo' => 'required|integer',
        ]);

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::with(['departamento', 'cargo', 'emails'])->find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}

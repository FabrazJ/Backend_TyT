<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        return Email::all(); // Obtener todos los emails
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'idUsuario' => 'nullable|integer',
            'idDepartamento' => 'nullable|integer',
            'tipo' => 'nullable|string|max:50',
            'activo' => 'required|boolean',
        ]);

        $email = Email::create($request->all());
        return response()->json($email, 201);
    }

    public function show($id)
    {
        $email = Email::find($id);
        if (!$email) {
            return response()->json(['message' => 'Email no encontrado'], 404);
        }

        return response()->json($email);
    }

    public function update(Request $request, $id)
    {
        $email = Email::find($id);
        if (!$email) {
            return response()->json(['message' => 'Email no encontrado'], 404);
        }

        $email->update($request->all());
        return response()->json($email);
    }

    public function destroy($id)
    {
        $email = Email::find($id);
        if (!$email) {
            return response()->json(['message' => 'Email no encontrado'], 404);
        }

        $email->delete();
        return response()->json(['message' => 'Email eliminado correctamente'], 200);
    }
}

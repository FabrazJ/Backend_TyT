<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        return Cargo::all(); // Obtener todos los cargos
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50',
            'nombre' => 'required|string|max:100',
            'activo' => 'required|boolean',
            'idUsuarioCreacion' => 'required|integer',
        ]);

        $cargo = Cargo::create($request->all());
        return response()->json($cargo, 201);
    }

    public function show($id)
    {
        $cargo = Cargo::find($id);
        if (!$cargo) {
            return response()->json(['message' => 'Cargo no encontrado'], 404);
        }

        return response()->json($cargo);
    }

    public function update(Request $request, $id)
    {
        $cargo = Cargo::find($id);
        if (!$cargo) {
            return response()->json(['message' => 'Cargo no encontrado'], 404);
        }

        $cargo->update($request->all());
        return response()->json($cargo);
    }

    public function destroy($id)
    {
        $cargo = Cargo::find($id);
        if (!$cargo) {
            return response()->json(['message' => 'Cargo no encontrado'], 404);
        }

        $cargo->delete();
        return response()->json(['message' => 'Cargo eliminado correctamente'], 200);
    }
}

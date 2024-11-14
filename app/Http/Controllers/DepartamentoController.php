<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    // Método para obtener todos los departamentos
    public function index()
    {
        return Departamento::all();  // Devuelve todos los departamentos
    }

    // Método para crear un nuevo departamento
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:50',
            'nombre' => 'required|string|max:100',
            'activo' => 'required|boolean',
            'idUsuarioCreacion' => 'required|integer',
        ]);

        // Crear un nuevo departamento
        $departamento = Departamento::create($request->all());

        return response()->json($departamento, 201);  // Retorna el departamento creado
    }

    // Método para obtener un departamento específico
    public function show($id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        return response()->json($departamento);
    }

    // Método para actualizar un departamento existente
    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        $departamento->update($request->all());

        return response()->json($departamento);  // Devuelve el departamento actualizado
    }

    // Método para eliminar un departamento
    public function destroy($id)
    {
        $departamento = Departamento::find($id);

        if (!$departamento) {
            return response()->json(['message' => 'Departamento no encontrado'], 404);
        }

        $departamento->delete();  // Eliminar el departamento

        return response()->json(['message' => 'Departamento eliminado correctamente'], 200);
    }
}

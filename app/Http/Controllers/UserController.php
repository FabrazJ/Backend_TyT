<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Esta línea es para utilizar el método Hash para cifrar la contraseña

class UserController extends Controller
{
    // Método para mostrar el formulario de creación
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request){
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Crear el usuario después de validar
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  // Asegúrate de que la contraseña esté cifrada
        ]);

        // Redirigir a la lista de usuarios después de crear
        return redirect()->route('users.index');
    }
        // Método para mostrar todos los usuarios
    public function index()
        {
            $users = User::all();  // Obtiene todos los usuarios
            return view('users.index', compact('users'));  // Pasa los usuarios a la vista
        }
}

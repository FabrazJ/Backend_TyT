<?php

use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de usuario
Route::get('users', [UserController::class, 'index']);  // Obtener todos los usuarios
Route::post('users', [UserController::class, 'store']); // Crear un nuevo usuario
Route::get('users/{id}', [UserController::class, 'show']); // Obtener un usuario específico
Route::put('users/{id}', [UserController::class, 'update']); // Actualizar un usuario
Route::delete('users/{id}', [UserController::class, 'destroy']); // Eliminar un usuario

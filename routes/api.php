<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas de usuario
Route::get('cargos', [CargoController::class, 'index']);
Route::get('cargos/{id}', [CargoController::class, 'show']);
Route::post('cargos', [CargoController::class, 'store']);
Route::put('cargos/{id}', [CargoController::class, 'update']);
Route::delete('cargos/{id}', [CargoController::class, 'destroy']);

// Rutas para Email
Route::get('emails', [EmailController::class, 'index']);
Route::get('emails/{id}', [EmailController::class, 'show']);
Route::post('emails', [EmailController::class, 'store']);
Route::put('emails/{id}', [EmailController::class, 'update']);
Route::delete('emails/{id}', [EmailController::class, 'destroy']);

// Rutas para User
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

Route::get('departamentos', [DepartamentoController::class, 'index']);   // Listar departamentos
Route::get('departamentos/{id}', [DepartamentoController::class, 'show']); // Ver departamento
Route::post('departamentos', [DepartamentoController::class, 'store']);   // Crear departamento
Route::put('departamentos/{id}', [DepartamentoController::class, 'update']); // Actualizar departamento
Route::delete('departamentos/{id}', [DepartamentoController::class, 'destroy']); // Eliminar departamento

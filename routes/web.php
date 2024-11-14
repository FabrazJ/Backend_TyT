<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('departamentos', DepartamentoController::class);
Route::resource('cargos', CargoController::class);
Route::resource('emails', EmailController::class);

Route::get('/users', [UserController::class, 'index'])->name('users.index');

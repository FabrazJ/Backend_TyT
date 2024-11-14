<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   // database/seeders/DatabaseSeeder.php

public function run()
{
    // Insertando en departamentos
    \App\Models\Departamento::insert([
        ['codigo' => 'D01', 'nombre' => 'Ventas', 'activo' => 1, 'idUsuarioCreacion' => 1],
        ['codigo' => 'D02', 'nombre' => 'Marketing', 'activo' => 1, 'idUsuarioCreacion' => 2],
        // ...
    ]);

    // Insertando en cargos
    \App\Models\Cargo::insert([
        ['codigo' => 'C01', 'nombre' => 'Gerente', 'activo' => 1, 'idUsuarioCreacion' => 1],
        ['codigo' => 'C02', 'nombre' => 'Desarrollador Backend', 'activo' => 1, 'idUsuarioCreacion' => 2],
        // ...
    ]);

    // Insertando en users
    \App\Models\User::insert([
        ['usuario' => 'juanperez', 'primerNombre' => 'Juan', 'primerApellido' => 'Pérez', 'idDepartamento' => 1, 'idCargo' => 1],
        ['usuario' => 'mariaflores', 'primerNombre' => 'María', 'primerApellido' => 'Flores', 'idDepartamento' => 2, 'idCargo' => 2],
        // ...
    ]);

    // Insertando en emails
    \App\Models\Email::insert([
        ['email' => 'ventas@example.com', 'idDepartamento' => 1, 'tipo' => 'corporativo', 'activo' => 1],
        ['email' => 'marketing@example.com', 'idDepartamento' => 2, 'tipo' => 'corporativo', 'activo' => 1],
        // ...
    ]);
}

}

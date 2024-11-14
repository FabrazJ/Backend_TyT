<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario', 'primerNombre', 'segundoNombre',
        'primerApellido', 'segundoApellido', 'idDepartamento', 'idCargo'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'idDepartamento');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'idCargo');
    }

    public function emails()
    {
        return $this->hasMany(Email::class, 'idUsuario');
    }
}

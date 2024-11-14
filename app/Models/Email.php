<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'idUsuario', 'idDepartamento', 'tipo', 'activo'];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'idDepartamento');
    }
}

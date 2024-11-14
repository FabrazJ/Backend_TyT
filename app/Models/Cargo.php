<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{

    use HasFactory;

    protected $fillable = ['codigo', 'nombre', 'activo', 'idUsuarioCreacion'];

    public function users()
    {
        return $this->hasMany(User::class, 'idCargo');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'primerNombre',
        'segundoNombre',
        'apellidoPaterno',
        'apellidoMaterno',
        'genero',
        'fechaNacimiento',
        'entidadFederativa',
        'claveE',
        'telefono',
        'curp',
        'domicilio',
        'idUsuario',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal_empleado extends Model
{
    use HasFactory;
    protected $fillable = [
        'idSucursal',
        'idEmpleado',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'fecha',
        'idSucursalEmpleado',
        'pago',
        'status',
    ];

    public function detalle_venta()
    {
        return $this->hasMany(Detalle_venta::class,'idVentas');
    }
}

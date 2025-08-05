<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'idCompra',
        'idProducto',
        'cantidad',
        'porcentaje_ganancia',
        'costo_unitario',
    ];
    public $timestamps = false;
    protected $casts = [
        'fecha_caducidad' => 'datetime:Y-m-d',
    ];
}

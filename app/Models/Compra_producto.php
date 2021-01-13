<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra_producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'idCompras',
        'idProductos',
        'cantidad',
        'porcentaje_ganancia',
        'fecha_caducidad',
        'costo_unitario',
        'iva',
    ];
    public $timestamps = false;
    protected $casts = [
        'fecha_caducidad' => 'datetime:Y-m-d',
    ];
}

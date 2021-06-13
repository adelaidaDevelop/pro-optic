<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_contra_entrega extends Model
{
    use HasFactory;
    protected $fillable = [
        'idCliente',
        'idSucursal',
        'direccion',
        'subtotal',
        'costoEnvio',
        'total',
        'pagarCon',
        'cambio'
    ];
}

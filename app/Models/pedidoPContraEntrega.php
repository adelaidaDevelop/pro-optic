<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedidoPContraEntrega extends Model
{
    use HasFactory;
    protected $fillable = [
        'idCliente',
        'direccion',
        'subtotal',
        'costoEnvio',
        'total',
        'pagarCon',
        'cambio'
    ];
}

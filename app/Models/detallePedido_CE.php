<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallePedido_CE extends Model
{
    use HasFactory;
    protected $fillable = [
        'idPedido',
        'idProducto',
        'precio',
        'cantidad',
        'subtotal'
    ];
}

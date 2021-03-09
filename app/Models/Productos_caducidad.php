<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos_caducidad extends Model
{
    use HasFactory;
    protected $table = 'productos_caducidad';
    protected $fillable = [
        'idProducto',
        'fecha_caducidad',
        'cantidad',
        'oferta',
    ];
}

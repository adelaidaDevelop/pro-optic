<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_venta extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'idProducto',
        'precio_ind',
        'subtotal',
        'idVentas',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class,'idVentas');
    }
}

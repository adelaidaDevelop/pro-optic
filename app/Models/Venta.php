<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

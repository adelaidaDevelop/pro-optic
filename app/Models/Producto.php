<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'idDepartamento',
        'codigoBarras',
        'nombre',
        'receta',
        'descripcion',
        'imagen',
        //'minimo_stock',
        //'existencia',
        //'costo',
        //'precio',
    ];
    protected $guarded = [];
}

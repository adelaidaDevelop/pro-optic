<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lente extends Model
{
    use HasFactory;
    protected $fillable = [
        'idProducto',
        'sph',
        'cyl',
        'adicion',
        'tratamiento',
        'disenio',
        'material',
        'espesor',
        'diametro'
    ];
    protected $guarded = [];
}

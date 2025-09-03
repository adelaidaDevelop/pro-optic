<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lente extends Model
{
    use HasFactory;
    protected $fillable = [
        'idProducto',
        'SPH',
        'CYL',
        'tratamiento',
        'adición',
        'diseño',
        'material'
    ];
    protected $guarded = [];
}

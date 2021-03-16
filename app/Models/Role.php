<?php

namespace App\Models;

use App\Models\Sucursal_empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(Sucursal_empleado::class)->withTimestamps();
    }
}

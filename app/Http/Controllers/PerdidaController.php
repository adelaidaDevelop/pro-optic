<?php

namespace App\Http\Controllers;

use App\Models\Perdida;
use Illuminate\Http\Request;

class PerdidaController extends Controller
{
    public function index()
    {
        $usuarios = ['verProducto','modificarProducto','eliminarProducto','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        return view('Producto.perdidasSucursal');
    }
}

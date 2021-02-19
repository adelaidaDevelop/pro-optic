<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('Administracion.index');
    }

    public function empleados()
    {
        return redirect('puntoVenta/empleado');
    }

    public function sucursales()
    {
        return redirect('puntoVenta/sucursal');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sucursal_empleado;
use App\Models\Role;
use App\Models\Modulo;
class HomeController extends Controller
{

    public function __construct(){  }

    public function index()
    {
    //    return session('idEmpleado');
        //return view('home');
        //$request->user()->authorizeRoles(['user', 'admin']);
    //    return session()->all();
        /*$modulos = Modulo::all();
        $roles = Role::all();
        $empleado = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
        foreach($modulos as $modulo)
        {
            $rolesModulo = [];
            foreach($roles as $rol)
            {
                if($modulo->id == $rol->idModulo)
                {

                }
            }
        }
        $usuarios = ['admin','crearVenta'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);*/

            return redirect('puntoVenta/venta');
    }
}

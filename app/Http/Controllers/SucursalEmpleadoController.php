<?php

namespace App\Http\Controllers;

use App\Models\Sucursal_empleado;
use App\Models\Role_sucursal_empleado;
use App\Models\Role;
use Illuminate\Http\Request;

class SucursalEmpleadoController extends Controller
{
    public function store(Request $request)
    {
        $usuarios = ['crearEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $sucursal_empleado = new Sucursal_empleado;
        $sucursal_empleado->idSucursal = $request->input('idSucursal');
        $sucursal_empleado->idEmpleado = $request->input('idEmpleado');
        $sucursal_empleado->status = 'alta';
        $sucursal_empleado->save();
        $roles = Role::where('idModulo', 3)->get();//->first();
        foreach($roles as $rol)
        {
            $sucursal_empleado->roles()->attach($rol);
        }

        return true;
    }

    public function show($sucursal)//Sucursal_empleado $sucursal_empleado)
    {
        $usuarios = ['verEmpleado','crearEmpleado','eliminarEmpleado','modificarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
            return Sucursal_empleado::where('idSucursal','=',$sucursal)->get();
    }
    public function update(Request $request,$id)//Request $request, Sucursal_empleado $sucursal_empleado)
    {
        $usuarios = ['modificarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        if($request->has('status'))
        {
            Sucursal_empleado::findOrFail($id)->update(['status' => $request->input('status')]);
            return true;
        }
        if($id == 'permisos')
        {
            $datos = $request->input('permisos');
            $id = $request->input('idSE');
            $permisos = json_decode($datos, true);
            $sE = Sucursal_empleado::findOrFail($id)->roles();
            $sE->detach();
            foreach($permisos as $idP)
            {
                $rol = Role::findOrFail($idP);
                $sE->attach($rol);
            }
            return 'Listo';
        }
        return $request;
    }
    public function permisosEmpleado($id)
    {
        return Sucursal_empleado::findOrFail($id)->roles()->get();//->where('sucursal_empleado_id',$id)->get();
    }
    public function editarEmpleado(Request $request,$id)
    {
        $usuarios = ['modificarEmpleado','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        if($request->has('status'))
        {
            Sucursal_empleado::findOrFail($id)->update(['status' => $request->input('status')]);
            return true;
        }
        if($id == 'permisos')
        {
            $datos = $request->input('permisos');
            $id = $request->input('idSE');
            $permisos = json_decode($datos, true);
            //$rsE = Role_sucursal_empleado::where('sucursal_empleado_id','=',$id);//->get();
            //$rsE->delete();
            $sE = Sucursal_empleado::findOrFail($id)->roles();
            $sE->detach();
            foreach($permisos as $idP)
            {
                $rol = Role::findOrFail($idP);
                $sE->attach($rol);
            }
            return 'Listo';
        }
        return $request;
    }
}

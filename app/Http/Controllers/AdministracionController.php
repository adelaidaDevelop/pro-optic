<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Sucursal_empleado;
use App\Models\Departamento;
use App\Models\Role;
use App\Models\Modulo;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
class AdministracionController extends Controller
{
    public function __construct(){}

    public function index()
    {
        $usuariosSucursal = ['admin','verSucursal','crearSucursal','eliminarSucursal','modificarSucursal'];
        $usuariosEmpleado = ['admin','verEmpleado','crearEmpleado','eliminarEmpleado','modificarEmpleado'];//,'admin'];
        $sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));//->authorizeRoles($usuarios);
        if($sE->hasAnyRole($usuariosSucursal))
        {
            $sucursalesInac = Sucursal::where('status', '=', 0)->get();
            $depa =Departamento::all();
            return view('Administracion.index', $sucursalesInac, compact('depa'));
        }
        if($sE->hasAnyRole($usuariosEmpleado))
            {return redirect('puntoVenta/empleado');}
        return abort_unless(false, 401);
    }

    public function edit($id)
    {
        $usuarios = ['admin','verSucursal','modificarSucursal','eliminarSucursal'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        if(session('idUsuario') != 1 && $id != session('sucursal'))
                {return redirect('/puntoVenta/administracion');}
        $depa = Departamento::all();
        $datosD['d'] = Sucursal::findOrFail($id);
        $sucursal = Sucursal::findOrFail($id);
        $roles = Role::all();
        $modulos = Modulo::all();
        return view('Administracion.index',$datosD,compact('sucursal', 'depa','roles','modulos'));
    }
    public function store(Request $request)
    {
        $usuarios = ['admin','crearSucursal'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $datosCliente = request()->except('_token');
        $validator =  Validator::make($datosCliente, [
                'direccion' => ['required', 'string', 'max:191','unique:sucursals'],
                'telefono' => ['required', 'string', 'max:10'],
            ]);
        $validator->validate();
        $datosCliente['status'] = 1;
        $sucursal = Sucursal::create($datosCliente);
        $sucursalEmpleado = Sucursal_empleado::create([
            'idSucursal' => $sucursal->id,
            'idEmpleado' => 1,
            'status' => 'alta'
        ]);
        $role_admin = Role::where('name', 'admin')->first();
        $sucursalEmpleado->roles()->attach($role_admin);
        return redirect('puntoVenta/administracion')->withErrors(['mensajeConf' => 'ESTA SUCURSAL SE AGREGO CORRECTAMENTE']);
    }

    public function update(Request $request, $id)
    {
        $usuarios = ['admin','modificarSucursal'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);

            $datosCliente = request()->except(['_token','_method']);
            $datos = [];
            $sucursal = Sucursal::findOrFail($id);
            if($request->input('direccion') != $sucursal->direccion)
                {$datos = Arr::add($datos,'direccion',$request->input('direccion'));}
            if($request->input('telefono') != $sucursal->telefono)
                {$datos = Arr::add($datos,'telefono',$request->input('telefono'));}
            $validator =  Validator::make($datos, [
                'direccion' => ['string', 'min:5', 'max:191','unique:sucursals'],
                'telefono' => ['string', 'min:7','max:10'],
            ]);
            $validator->validate();
            $dir = $request['direccion'];
            $telefono = $request['telefono'];
            $sucursal = Sucursal::findOrFail($id);
            $dirAnt= $sucursal->direccion;
            $telefonoAnt= $sucursal->telefono;
            if( $dir == $dirAnt && $telefono == $telefonoAnt )
            {
                return redirect()->back()->withErrors(['mensajeError' => 'PARA EDITAR DEBE MODIFICAR AL MENOS UN ELEMENTO']);
            }
            else{
            $sucursal->update($datosCliente);
            if($id == session('sucursal'))
                {session(['sucursalNombre' => $sucursal->direccion]);}
            return redirect('puntoVenta/administracion')->withErrors(['mensajeConf' => 'ESTA SUCURSAL SE EDITO CORRECTAMENTE']);
        }
    }

    public function buscador(Request $request)
    {
        $datosConsulta['sucursalB'] = Sucursal::where("direccion",'like',$request->texto."%")->get();
        return view('Administracion.form',$datosConsulta);
    }
}

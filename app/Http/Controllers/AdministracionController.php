<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Sucursal_empleado;
use App\Models\Departamento;
use App\Models\Role;
use App\Models\Modulo;


class AdministracionController extends Controller
{
    public function __construct()
    {
        //$usuarios = ['admin',];//,'admin'];
        //Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
    }
    public function index()
    {
         $usuarios = ['admin','verSucursal','crearSucursal','eliminarSucursal','modificarSucursal'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        $sucursalesInac = Sucursal::where('status', '=', 0)->get();
        $depa =Departamento::all();
      //  $sucursalesInac = Sucursal::where('status', '=', 0)->get();
        return view('Administracion.index', $sucursalesInac, compact('depa'));
    }

    public function edit($id)
    {
        $usuarios = ['admin','verSucursal','modificarSucursal','eliminarSucursal'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
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
        $datosCliente['status'] = 1;
        //Sucursal::insert($datosCliente);
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
                session(['sucursalNombre' => $sucursal->direccion]);
            return redirect('puntoVenta/administracion')->withErrors(['mensajeConf' => 'ESTA SUCURSAL SE EDITO CORRECTAMENTE']);
        }
        /*
        $datosCliente = request()->except(['_token','_method']);
        Sucursal::where('id','=',$id)->update($datosCliente);
        return redirect('puntoVenta/administracion');
        */
    }

    public function destroy($id)//Departamento $departamento)
    {
        
    }

    public function buscador(Request $request)
    {
      //  $idSucursal = session('sucursal');
       // $depa = Departamento::all();
        $datosConsulta['sucursalB'] = Sucursal::where("direccion",'like',$request->texto."%")->get();
        return view('Administracion.form',$datosConsulta);
        //return $datosConsulta;
    }
}

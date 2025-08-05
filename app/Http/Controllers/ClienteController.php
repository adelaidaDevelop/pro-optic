<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Sucursal_empleado;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $usuarios = ['admin','modificarCliente','verCliente','eliminarCliente','crearCliente'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $datos['proveedores'] = Cliente::paginate();
        return view('Cliente.index',$datos);
    }
    public function store(Request $request)
    {
        $usuarios = ['admin','crearCliente'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $datosCliente = request()->except('_token');
        $datosCliente['tipo']= 0; //0 para clientes deudores
        $datosCliente['idUsuario'] = 2;
        Cliente::insert($datosCliente);

        return redirect('puntoVenta/cliente')->withErrors(['mensajeConf' => 'EL CLIENTE SE AGREGO CORRECTAMENTE']);
    }

    public function edit($id)
    {
      //  $datos['departamentos'] = Cliente::paginate();
        $usuarios = ['admin','modificarCliente','verCliente','eliminarCliente'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $datosD['d'] = Cliente::findOrFail($id);
        return view('Cliente.index',$datosD);
    }
    public function update(Request $request, $id)
    {
        $usuarios = ['admin','modificarCliente'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
            $datosCliente = request()->except(['_token','_method']);
            $nombre = $request['nombre'];
            $telefono = $request['telefono'];
            $domicilio = $request['domicilio'];
            $cliente = Cliente::findOrFail($id);
            $nombreAnt= $cliente->nombre;
            $telefonoAnt= $cliente->telefono;
            $domicilioAnt= $cliente->domicilio;
            if( $nombre == $nombreAnt && $telefono == $telefonoAnt && $domicilio == $domicilioAnt)
            {
                return redirect()->back()->withErrors(['mensajeError' => 'PARA EDITAR DEBE MODIFICAR AL MENOS UN ELEMENTO']);
            }
            $cliente['nombre'] = $request['nombre'];
            $cliente['telefono'] = $request['telefono'];
            $cliente['domicilio'] = $request['domicilio'];
            $cliente->update();
            return redirect('puntoVenta/cliente')->withErrors(['mensajeConf' => 'ESTE CLIENTE SE EDITO CORRECTAMENTE']);
    }

    public function destroy($id)//Departamento $departamento)
    {
        $usuarios = ['admin','eliminarCliente'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        try{
            Cliente::destroy($id);
            return true;
            }catch(\Illuminate\Database\QueryException $e){
                return false;
            }
    }
    public function baja($id){
        $usuarios = ['admin','eliminarCliente'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $sucursal['status'] =0;
        $suc2 = Cliente::findOrFail($id);
        $suc2->update($sucursal);
        return redirect('puntoVenta/cliente')->withErrors(['mensajeConf' => 'EL CLIENTE SE DIO DE BAJA CORRECTAMENTE']);
    }
    public function destroy2($id)//Departamento $departamento)
    {
        $usuarios = ['admin','eliminarCliente'];//,'admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        try{
        Cliente::destroy($id);
        return true;
        }catch(\Illuminate\Database\QueryException $e){
            return false;
        }
    }
    public function buscador(Request $request)
    {
        $datosConsulta['clienteB'] = Cliente::where("nombre",'like',$request->texto."%")->get();
        return view('cliente.form',$datosConsulta);
    }
    public function listaDeudor(){
        return view('ListaDeudor.index');
    }
}

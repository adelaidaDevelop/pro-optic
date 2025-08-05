<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Sucursal_empleado;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct(){}

    public function index()
    {
        $usuarios = ['verCompra','crearCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $datos['proveedores'] = Proveedor::paginate();
        return view('Proveedor.index',$datos);
    }

    public function store(Request $request)
    {
        try{
        $datosProveedor = request()->except('_token');
        $datosProveedor['status'] = 1;
        Proveedor::insert($datosProveedor);
        }catch (\Illuminate\Database\QueryException $e){
            return redirect()->back()->withInput()->withErrors(['mensajeError' => 'YA EXISTE UN PROVEEDOR CON EL MISMO NOMBRE Y NO ES POSIBLE REPETIRLO']);
        }
        return redirect('puntoVenta/proveedor')->withErrors(['mensajeConf' => 'EL PROVEEDOR SE AGREGO CORRECTAMENTE']);
    }
    public function show($proveedor)
    {
        if($proveedor == 'proveedor')
            {return Proveedor::where('status', '=',true)->get();}
        if($proveedor == 'baja')
        {
            return Proveedor::where('status', '=', false)->get();
        }
    }

    public function edit($id)
    {
        $datosD['d'] = Proveedor::findOrFail($id);
        if($datosD['d']->status)
            {return view('Proveedor.index',$datosD);}
        return redirect('/puntoVenta/proveedor');
    }

    public function update(Request $request, $id)
    {
        $datosProveedor = request()->except(['_token','_method']);
        $nombre = $request['nombre'];
        $rfc= $request['rfc'];
        $telefono = $request['telefono'];
        $direccion= $request['direccion'];
        $proveedor = Proveedor::findOrFail($id);
        $nombreAnt= $proveedor->nombre;
        $rfcAnt= $proveedor->rfc;
        $telefonoAnt= $proveedor->telefono;
        $direccionAnt= $proveedor->direccion;
        if( $nombre == $nombreAnt && $rfc == $rfcAnt && $telefono == $telefonoAnt && $direccion == $direccionAnt)
        {
            return redirect()->back()->withErrors(['mensajeError' => 'PARA EDITAR DEBE MODIFICAR AL MENOS UN ELEMENTO']);
        }else {
        $proveedor->update($datosProveedor);
        return redirect('puntoVenta/proveedor')->withErrors(['mensajeConf' => 'PROVEEDOR EDITADO CORRECTAMENTE']);
        }
    }

    public function destroy($id)//Departamento $departamento)
    {
        Proveedor::findOrFail($id)->update(['status' => false]);
        return redirect('/puntoVenta/proveedor')->withErrors(['mensajEli' => 'PROVEEDOR DADO DE BAJA EXITOSAMENTE']);
    }

    public function buscador(Request $request)
    {
        $datosConsulta['proveedorB'] = Proveedor::where("nombre",'like',$request->texto."%")->get();
        return view('Proveedor.form',$datosConsulta);
    }
    public function editarProveedor(Request $request, $id)
    {
        if($request->has('status'))
        {
            Proveedor::findOrFail($id)->update(['status' => true ]);
            return true;
        }
    }
}

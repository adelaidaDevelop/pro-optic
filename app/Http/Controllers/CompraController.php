<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Detalle_compra;
use App\Models\Producto;
use App\Models\Productos_caducidad;
use App\Models\Departamento;
use App\Models\Proveedor;
use App\Models\Pago_compra;
use App\Models\Sucursal_empleado;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CompraController extends Controller
{
    public function index()
    {
        $usuarios = ['verCompra','crearCompra','modificarCompra','verPago','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);

        $compras = Compra::all();
        $comprasSucursal = [];
        foreach($compras as $c)
        {
            $sE = Sucursal_empleado::findOrFail($c->idSucursalEmpleado);
            if($sE->idSucursal == session('sucursal'))
                {array_push($comprasSucursal,$c);}
        }
        $depas['d']= Departamento::paginate();
        $proveedores= Proveedor::all();
        $productos= Producto::all();
        $compra_producto = Detalle_compra::all();
        return view('Compra.index',$depas, compact('productos','proveedores','compra_producto','comprasSucursal'));
    }

    public function create()
    {
        $usuarios = ['crearCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);

        $productos = Producto::all();
        $departamentos = Departamento::all();
        $proveedores = Proveedor::where('status', '=', true)->get();
        return view('Compra.create', compact('productos','departamentos','proveedores'));
    }
    public function store(Request $request)
    {
        $usuarios = ['crearCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);

        $datos = $request->input('datos');
        $proveedor = $request->input('proveedor');
        $estado = $request->input('estado');
        $fecha_compra = $request->input('fecha_compra');
        $iva = $request->input('iva');
        $datosCodificados = json_decode($datos,true);
        $compra = Compra::create([
            'idProveedor' => $proveedor,
            'fecha_compra' => $fecha_compra,
            'idSucursalEmpleado' => session('idSucursalEmpleado'),
            'estado' =>$estado,
            'IVA' => $iva,
        ]);
        if($estado =='credito')
        {
            $pagoCompra = $request->input('pago');
            if($pagoCompra>0)
            {
                $idSucEmp = session('idSucursalEmpleado');
                $pago = new Pago_compra;
                $pago->monto = $pagoCompra;
                $pago->	idEmpSuc = $idSucEmp;
                $pago->idCompra = $compra->id;
                $pago->save();
            }
        }
        foreach($datosCodificados as $datosProducto)
        {
            $producto = new Detalle_compra;
            $producto->idCompra = $compra->id;
            $producto->idProducto = $datosProducto['id'];
            $producto->cantidad = $datosProducto['cantidad'];
            $producto->porcentaje_ganancia = $datosProducto['ganancia'];
            $producto->costo_unitario = $datosProducto['costo'];
            $producto->save();
        }
        return true;
    }
    public function show($compra)
    {
        $usuarios = ['verCompra','modificarCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        $compras = Compra::all();
        if($compra=="compras")
        {
            return $compras;
        }
        else{
            $comprasSucursal = [];
            foreach($compras as $c)
            {
                $sE = Sucursal_empleado::findOrFail($c->idSucursalEmpleado);
                if($sE->idSucursal == $compra)
                    {array_push($comprasSucursal,$c);}
            }
            return $comprasSucursal;
        }
        return 'No hay nada';
    }
    public function update($id)//Request $request,$id)//, Compra $compra)
    {
        $usuarios = ['modificarCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        Compra::where('id','=',$id)->update(['estado' => 'pagado']);
        return $id;
    }

    public function estadoCompra(Request $request, $id)
    {
        $usuarios = ['modificarCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);
        Compra::where('id','=',$id)->update(['estado' => 'pagado']);
        return $id;
    }
/*
    public function buscadorProducto(Request $request)
    {
        //$datosConsulta['departamentosB'] = Departamento::where("nombre",'like',$request->texto."%")->get();
        $productos = Producto::where("nombre",'like',$request->texto."%")->get();
        return view('Compra.form',compact('productos'));
        //return compact('productos');
    }*/
}


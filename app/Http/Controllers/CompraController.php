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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                array_push($comprasSucursal,$c);
        }
        $depas['d']= Departamento::paginate();
        $proveedores= Proveedor::all();
        $productos= Producto::all();
        $compra_producto = Detalle_compra::all();
        return view('Compra.index',$depas, compact('productos','proveedores','compra_producto','comprasSucursal'));
        //return view('Compra.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = ['crearCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $productos = Producto::all();
        $departamentos = Departamento::all();
        $proveedores = Proveedor::where('status', '=', true)->get();
        return view('Compra.create', compact('productos','departamentos','proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosP= Producto::all();
        //$datos['departamentos'] = Producto::paginate();
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
                $pago = new Pago_compra;
                $pago->monto = $pagoCompra;
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
            //$producto->fecha_caducidad = $datosProducto['caducidad'];
            $producto->costo_unitario = $datosProducto['costo'];
            //$producto->iva = 'Si';
            //$producto->fecha_caducidad = Carbon::createFromFormat( 'Y/m/d', $datosProducto['caducidad']);
            $producto->save();
            
        }

        return true;//view('Venta.index',compact('datosP'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show($compra)
    {
        $usuarios = ['verCompra','modificarCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $compras = Compra::all();
        if($compra=="compras")
        {
            //$productosCodificados = json_encode($productos);
            return $compras;//compact('productos');
        }
        else{
            $comprasSucursal = [];
            foreach($compras as $c)
            {
                $sE = Sucursal_empleado::findOrFail($c->idSucursalEmpleado);
                if($sE->idSucursal == $compra)
                    array_push($comprasSucursal,$c);
            }
            return $comprasSucursal;
        }
        return 'No hay nada';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update($id)//Request $request,$id)//, Compra $compra)
    {
        $usuarios = ['modificarCompra','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        Compra::where('id','=',$id)->update(['estado' => 'pagado']);
        //$estado = $request->input('estado');
        return $id;//'Obvio que retorno algo :v';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
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
?>
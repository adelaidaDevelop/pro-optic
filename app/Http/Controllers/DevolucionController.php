<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Venta;
use App\Models\Detalle_venta;
use App\Models\Producto;
use App\Models\Empleado;
use App\Models\Sucursal;
use App\Models\Sucursal_empleado;
use App\Models\Sucursal_producto;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = ['verDevolucion','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $ventas= Venta::all();
        $detalleVenta= Detalle_venta::all();
        $productos= Producto::all();
        $idSucursal = session('sucursal');
        $empleados= Empleado::all();
        $devolucions = Devolucion::all();
        $idSucursal = session('sucursal');
        $sucursalEmpleado = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        $productX_Sucursal = Sucursal_producto::where('id','=', $idSucursal)->get();
        return view('Devolucion.index', compact('ventas', 'detalleVenta', 'productos', 'empleados', 'devolucions', 'sucursalEmpleado',  'productX_Sucursal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
    public function store(Request $request)
    {
        $usuarios = ['crearDevolucion','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $cantProducto= $request->input('cantidad');
        $detalle= $request->input('detalle');
        $precio= $request->input('precio');
        $idProducto= $request->input('idProducto');
        $idVenta= $request->input('idVenta');
            $devolucion = new Devolucion;
            $devolucion->idProducto = $idProducto;
            $devolucion->idVenta = $idVenta;
            $devolucion->cantidad = $cantProducto;
            $devolucion->observacion= $detalle;
            $devolucion->precio = $precio;
            $devolucion->save();
    
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function show(Devolucion $devolucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function edit(Devolucion $devolucion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devolucion $devolucion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devolucion  $devolucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devolucion $devolucion)
    {
        //
    }
    public function datosDevoluciones(){
        $devolucions = Devolucion::all();
        return compact('devolucions');
    }
    public function datosVenta(){
        $ventas= Venta::all();
        return compact('ventas');
    }
    
    public function datosDetalleVenta(){
        $detalleVenta= Detalle_venta::all();
        return compact('detalleVenta');
    }
    public function datosProducto(){
        $productos= Producto::all();
        return compact('productos');
    }
    public function datosEmpleado(){
        $empleados= Empleado::all();
        return compact('empleados');
    }

    public function datoDev()
    {
        $devolucions = Devolucion::all();
        return $devolucions;
    }

}

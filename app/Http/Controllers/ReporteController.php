<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Venta;
use App\Models\Pago_venta;
use App\Models\Devolucion;
use App\Models\Pago_compra;
use App\Models\Compra;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Departamento;
use App\Models\Detalle_compra;
use App\Models\Detalle_venta;
use App\Models\Sucursal_empleado;
use App\Models\Sucursal_producto;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function __construct()
    {
        //$usuarios = ['admin',];//,'admin'];
        //Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = ['verCorte','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        //CORTE DE CAJA INDEX
        $ventas = Venta::all();
        $pagos = Pago_venta::all();
        $devoluciones = Devolucion::all();
        $pagoCompras= Pago_compra::all();
        $compras = Compra::all();
        $empleados = Empleado::all();
        //Seleccionar empleados que son cajeros
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        //return $sucursalEmpleados;
        return view('Reportes.corteCaja', compact('empleados','ventas', 'pagos', 'devoluciones','pagoCompras','compras','sucursalEmpleados'));
    }

    public function index2()
    {
        //REPORTE INVENTARIO INDEX
        $usuarios = ['verReporte','admin'];
        Sucursal_empleado::findOrFail(session('idSucursalEmpleado'))->authorizeRoles($usuarios);  
        
        $empleados = Empleado::all();
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        $compras= Compra::all();
        $detalleCompra= Detalle_compra::all();
        $productos= Producto::all();
        $devoluciones= Devolucion::all();
        $departamentos= Departamento::all();
        $ventas = Venta::all();
        $detalle_ventas = Detalle_venta::all();
        $sucursal_productos = Sucursal_producto::where('idSucursal','=', $idSucursal)->get();
        return view('Reportes.reporteInventario', compact('empleados','compras','detalleCompra', 'productos','devoluciones', 'departamentos','ventas', 'detalle_ventas', 'sucursal_productos', 'sucursalEmpleados'));
    }
    public function index3()
    {
        $empleados = Empleado::all();
        $idSucursal = session('sucursal');
        $sucursalEmpleados = Sucursal_empleado::where('idSucursal', '=', $idSucursal)->get();
        $productos= Producto::all();
        $departamentos= Departamento::all();
        $ventas = Venta::all();
        $detalle_ventas = Detalle_venta::all();
        $sucursal_productos = Sucursal_producto::where('idSucursal','=', $idSucursal)->get();
        return view('Reportes.reporteVentas', compact('empleados','sucursalEmpleados','productos','departamentos','ventas','detalle_ventas', 'sucursal_productos'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}

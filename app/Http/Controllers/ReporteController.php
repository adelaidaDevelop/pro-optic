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
use App\Models\Detalle_venta;

use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::all();
        $pagos = Pago_venta::all();
        $devoluciones = Devolucion::all();
        $pagoCompras= Pago_compra::all();
        $compras = Compra::all();
        //Seleccionar empleados que son cajeros
        //$cajero = Empleado::where
        $cajero = Empleado::all();
        return view('Reportes.corteCaja', compact('ventas', 'pagos', 'devoluciones','pagoCompras','compras','cajero'));
    }

    public function index2()
    {
        $cajero = Empleado::all();
        $compras= Compra::all();
        $compraProductos= Compra::all();
        $productos= Producto::all();
        $devoluciones= Devolucion::all();
        $departamentos= Departamento::all();
        $ventas = Venta::all();
        $detalle_ventas = Detalle_venta::all();

        return view('Reportes.reporteInventario', compact('cajero','compras','compraProductos', 'productos','devoluciones', 'departamentos','ventas', 'detalle_ventas'));
    }
    public function index3()
    {
        return view('Reportes.reporteVentas');
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

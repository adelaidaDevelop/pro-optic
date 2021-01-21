<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Venta;
use App\Models\Detalle_venta;
use App\Models\Producto;
use App\Models\Empleado;
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
        //
        $ventas= Venta::all();
        $detalleVenta= Detalle_venta::all();
        $productos= Producto::all();
        $empleados= Empleado::all();
        
        return view('Devolucion.index', compact('ventas', 'detalleVenta', 'productos', 'empleados'));
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
        $cantProducto= $request->input('cantidad');
        $detalle= $request->input('detalle');
        $totalDevolucion= $request->input('total');
        $idProducto= $request->input('idProducto');
        $idVenta= $request->input('idVenta');

       
            $devolucion = new Devolucion;
            $devolucion->idProducto = $idProducto;
            $devolucion->idVenta = $idVenta;
            $devolucion->cantProducto = $cantProducto;
            $devolucion->detalle= $detalle;
            $devolucion->totalDevolucion = $totalDevolucion;
            $devolucion->save();
        /*
            $actualizarProducto = Producto::find($datosProducto['id']); //->update(['existencia'=>]);
            $actualizarProducto->existencia = $actualizarProducto['existencia'] - $datosProducto['cantidad'];
            $actualizarProducto->save();
        
            */

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
}

<?php

namespace App\Http\Controllers;

use App\Models\Venta_cliente;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Detalle_venta;
use App\Models\Pago_venta;



use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venta_clientes= Venta_cliente::all();
        $cliente= Cliente::all();
        $ventas= Venta::all();
        $detalleVentas= Detalle_venta::all();
        $productos = Producto::all();
        $pagos_ventas= Pago_venta::all();
        
        
          return view('ListaDeudor.index', compact( 'venta_clientes', 'cliente','ventas','detalleVentas', 'productos','pagos_ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ListaDeudor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $datosProducto = request()->except('_token');
         Venta_cliente::insert($datosProducto);
         return redirect('credito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function show(Venta_cliente $credito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta_cliente $credito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta_cliente $credito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta_cliente $credito)
    {
        //
    }

    public function datosNuevos()
    {
        $credito= Venta_cliente::all();
        $cliente= Cliente::all();
        $ventas= Venta::all();
        $detalleVentas= Detalle_venta::all();
        $productos = Producto::all();
        $pagos= Pago_venta::all();
        
          return  compact( 'credito', 'cliente','ventas','detalleVentas', 'productos','pagos');
    }
}

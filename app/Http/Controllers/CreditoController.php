<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Detalle_venta;
use App\Models\Pago;



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
        $credito= Credito::all();
        $cliente= Cliente::all();
        $ventas= Venta::all();
        $detalleVentas= Detalle_venta::all();
        $productos = Producto::all();
        $pagos= Pago::all();
        
          return view('ListaDeudor.index', compact( 'credito', 'cliente','ventas','detalleVentas', 'productos','pagos'));
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
         Credito::insert($datosProducto);
         return redirect('credito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function show(Credito $credito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function edit(Credito $credito)
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
    public function update(Request $request, Credito $credito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credito  $credito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credito $credito)
    {
        //
    }

    public function datosNuevos()
    {
        $credito= Credito::all();
        $cliente= Cliente::all();
        $ventas= Venta::all();
        $detalleVentas= Detalle_venta::all();
        $productos = Producto::all();
        $pagos= Pago::all();
        
          return  compact( 'credito', 'cliente','ventas','detalleVentas', 'productos','pagos');
    }
}

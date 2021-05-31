<?php

namespace App\Http\Controllers;

use App\Models\historialPedido;
use Illuminate\Http\Request;

class HistorialPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Ecommerce.historialPedido');
    }
    public function index2()
    {
        //
        return view('Ecommerce.seguimiento_pedido');
    }
    public function index3()
    {
        //
        return view('Ecommerce.comprobante');
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
     * @param  \App\Models\historialPedido  $historialPedido
     * @return \Illuminate\Http\Response
     */
    public function show(historialPedido $historialPedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\historialPedido  $historialPedido
     * @return \Illuminate\Http\Response
     */
    public function edit(historialPedido $historialPedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\historialPedido  $historialPedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, historialPedido $historialPedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\historialPedido  $historialPedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(historialPedido $historialPedido)
    {
        //
    }
}

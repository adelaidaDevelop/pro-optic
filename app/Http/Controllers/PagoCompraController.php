<?php

namespace App\Http\Controllers;

use App\Models\Pago_compra;
use Illuminate\Http\Request;

class PagoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'retorna algo';
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
     * @param  \App\Models\Pago_compra  $pago_compra
     * @return \Illuminate\Http\Response
     */
    public function show($idCompra)//Pago_compra $pago_compra)
    {
        if($idCompra == 'pagos')
            return Pago_compra::all();
        //$pagos = NULL;
        $pagos = Pago_compra::where('idCompra','=',$idCompra);
        if(isset($pagos))
            return 'pagos no encontrados';
        else
            return $pagos;
        //var_dump();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago_compra  $pago_compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago_compra $pago_compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pago_compra  $pago_compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago_compra $pago_compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago_compra  $pago_compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago_compra $pago_compra)
    {
        //
    }
}

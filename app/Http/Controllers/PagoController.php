<?php

namespace App\Http\Controllers;

use App\Models\Pago_venta;
use App\Models\Venta;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $monto = $request->input('monto');
        $idVenta= $request->input('idVenta');
        $totalResta= $request->input('totalResta');
        $totalCompra = $request->input('totalCompra');
        
        if ($monto == $totalResta) {
            if($monto > 0)
            {
            $pago = new Pago_venta;
            $pago->monto = $monto;
            $pago->idVenta = $idVenta;
            $pago->save();
           // $datosProducto=request()->except(['_token', '_method']);
            $actEstadoVenta = Venta::find($idVenta);
            $actEstadoVenta->estado= "pagado";
            $actEstadoVenta->pago=$totalCompra;
            $actEstadoVenta->save();
          //  Producto::where('id', '=',$idVenta)->update($datosProducto);
            }
        } else {
            
            if($monto > 0)
            {
            $pago = new Pago_venta;
            $pago->monto = $monto;
            $pago->idVenta = $idVenta;
            $pago->save();
            }
        }
        return true;
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago_venta $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago_venta $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago_venta $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago_venta $pago)
    {
        //
    }
}
